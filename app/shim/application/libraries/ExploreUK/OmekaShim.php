<?php

namespace ExploreUK;

use PDO;

class OmekaShim
{
    private $link;
    private $config;
    private $theme;
    private $theme_options;

    public function __construct()
    {
        $api_config = parse_ini_file(EUK_BASE_DIR . '/db.ini', true);
        $this->config = $api_config['database'];
        $this->link = new \PDO(
            "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset=utf8mb4",
            $this->config['username'],
            $this->config['password'],
            array(
                \PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                \PDO::ATTR_PERSISTENT => true,
            )
        );
    }

    public function getOption($name)
    {
        $options = $this->getTableName('options');
        $query = "SELECT value FROM `$options` WHERE `name` = ?";
        $handle = $this->link->prepare($query);
        $handle->bindValue(1, $name);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        if (count($result) > 0) {
            return $result[0]->value;
        } else {
            return null;
        }
    }

    public function getThemeOption($name)
    {
        if (!isset($this->theme)) {
            $theme = $this->getOption('public_theme');
            $this->theme = $this->getOption('public_theme');
            $this->theme_options = $this->parseRegistry($this->getOption("theme_{$this->theme}_options"));
        }
        if (isset($this->theme_options[$name])) {
            return $this->theme_options[$name];
        } else {
            return false;
        }
    }

    public function getCollectionByTitle($title)
    {
        $colln = $this->getTableName('collections');
        $texts = $this->getTableName('element_texts');
        $query = "SELECT c.* FROM `$colln` AS c
                  INNER JOIN `$texts` AS e ON e.record_id = c.id
                  WHERE e.element_id = ? AND e.record_type = 'Collection'
                    AND e.text = ?
                  GROUP BY c.id";
        $handle = $this->link->prepare($query);
        $handle->bindValue(1, 50);
        $handle->bindValue(2, $title);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function getItems($collnId, $options = array())
    {
        $itemsTable = $this->getTableName('items');
        $query = "SELECT id FROM `$itemsTable`
                  WHERE `collection_id` = ?";
        if (isset($options['featured']) && $options['featured']) {
            $query .= ' AND `featured` = 1';
        }
        #if (isset($options['sort'])) {
        #    $query .= ' ORDER BY
        #}
        $handle = $this->link->prepare($query);
        $handle->bindValue(1, $collnId);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function getItemMetadata($itemId)
    {
        $itemsTable = $this->getTableName('items');
        $textsTable = $this->getTableName('element_texts');
        $query = "SELECT et.element_id AS field, et.text AS value FROM `$itemsTable` i
                  INNER JOIN `$textsTable` et
                      ON et.record_type = 'Item' AND et.record_id = i.id
                  WHERE (i.id = ?)
                      AND (et.element_id = 50 OR et.element_id = 46 OR et.element_id = 43)";
        $handle = $this->link->prepare($query);
        $handle->bindValue(1, $itemId);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        if (count($result) == 0) {
            return null;
        }
        $position = 0;
        foreach ($result as $row) {
            if ($row->field == 50) {
                $label = $row->value;
            } elseif ($row->field == 46) {
                $url = $row->value;
            } elseif ($row->field == 43) {
                $position = $row->value;
            }
        }
        $image = $this->getFile($itemId);
        return array(
            'image' => $image,
            'label' => $label,
            'url' => $url,
            'position' => $position,
        );
    }

    public function getFile($itemId)
    {
        $files = $this->getTableName('files');
        $query = "SELECT `filename` FROM `$files`
                  WHERE `item_id` = ?
                  ORDER BY `order` ASC
                  LIMIT 1";
        $handle = $this->link->prepare($query);
        $handle->bindValue(1, $itemId);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        $url = '';
        if (count($result) > 0) {
            $file = preg_replace('/\.[^\.]+$/', '.jpg', $result[0]->filename);
            $url = "/files/fullsize/$file";
        }
        return $url;
    }

    public function getSimplePages()
    {
        $pages = $this->getTableName('simple_pages_pages');
        $query = "SELECT id, slug FROM `$pages` WHERE is_published=1";
        $handle = $this->link->prepare($query);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        return $result;
    }

    public function getSimplePage($id)
    {
        $pages = $this->getTableName('simple_pages_pages');
        $query = "SELECT * FROM `$pages` WHERE id = ?";
        $handle = $this->link->prepare($query);
        $handle->bindValue(1, $id);
        $handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        return $result[0];
    }

    public function getTableName($raw)
    {
        return $this->config['prefix'] . $raw;
    }

    public function parseRegistry($string)
    {
        # a:5:{s:8:"euk_solr";s:42:"https://exploreuk.uky.edu/test/solr/select";s:23:"euk_findingaid_base_url";s:3 (etc.)

        # expected format: a:\d+:{s:\d+:"...";...s:\d+:"...";}
        # i.e., a single array of strings

        $options = array();
        preg_match('/^a:\d+:{(.*)}$/s', $string, $matches);
        $rest = $matches[1];
        while (strlen($rest) > 0) {
            # read a key
            preg_match('/^s:(\d+):"(.*)/', $rest, $matches);
            $len = $matches[1];
            $substring = $matches[2];
            $key = substr($substring, 0, $len);
            # followed by ";
            $rest = substr($substring, $len + 2);

            # read a value
            preg_match('/^s:(\d+):"(.*)/', $rest, $matches);
            $len = $matches[1];
            $substring = $matches[2];
            $value = substr($substring, 0, $len);
            # followed by ";
            $rest = substr($substring, $len + 2);

            $options[$key] = $value;
        }

        return $options;
    }
}
