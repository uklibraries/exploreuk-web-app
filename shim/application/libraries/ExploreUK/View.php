<?php
namespace ExploreUK;

class View
{
    private $metadata;
    private $query;
    private $templateFile;

    public function __construct($metadata, $template)
    {
        $this->metadata = $metadata;
        $this->query = $metadata['query'];
        $this->templateFile = dirname(__FILE__) . "/views/{$template}.php";
    }

    public function render()
    {
        $m = $this->metadata;
        require($this->templateFile);
    }

    public function q($key)
    {
        return $this->query->q($key);
    }

    public function suggestedLink($term)
    {
        return $this->query->suggestedLink($term);
    }

    public function brevity($message, $length = 0)
    {
        if ($length == 0) {
            $length = EUK_MAX_LABEL;
        }
        if (strlen($message) <= $length) {
            return $message;
        }
        $source_words = preg_split('/\b/', $message);
        $target_words = array();
        $current_length = 0;
        foreach ($source_words as $word) {
            if (($current_length == 0) || $current_length + strlen($word) <= $length) {
                $target_words[] = $word;
                $current_length += strlen($word);
            } else {
                break;
            }
        }
        $count = count($target_words);
        if ($count == 0) {
            $message = '…';
        } else {
            $terminal = $target_words[$count - 1];
            if (preg_match('/^\W+$/', $terminal)) {
                array_pop($target_words);
            }
            $message = implode('', $target_words) . '…';
        }
        return $message;
    }

    public function renderField($hash)
    {
        $euk_locale = EUK_LOCALE;
        $field = $hash['key'];
        $content = $hash['value'];
        if ($field === 'collection_url') {
            if (strlen($content['source_s']) > 0) {
                $field_label = $euk_locale['en']['source_s'];
                $collection_label = $euk_locale['en']['open_collection_guide'];
                $link = "/?f%5Bsource_s%5D%5B%5D=";
                $link_label = $euk_locale['en']['more_items'];
                $lines = array(
                    "<h3>$field_label</h3>\n",
                    '<p>',
                    $content['source_s'],
                    ' | ',
                    $this->renderLink($this->path("/catalog/{$content['base_id']}"), $collection_label, true),
                    ' | ',
                    $this->renderLink($this->path($link . urlencode($content['source_s'])), $link_label, true),
                    '</p>',
                );
                return implode('', $lines);
            } else {
                return '';
            }
        }
        /* XXX - special handling for old rights statements
        * Please remove when the index is clean.
        */
        if ($field === 'usage_display') {
            $content = preg_replace('/Please go to http:\/\/kdl.kyvl.org for more information\./', 'For information about permissions to reproduce or publish, <a href="https://libraries.uky.edu/ContactSCRC" target="_blank" rel="noopener">contact the Special Collections Research Center</a>.', $content);
        }
        if (isset($euk_locale['en'][$field])) {
            $label = $euk_locale['en'][$field];
        } else {
            $label = 'Unknown';
        }
        $lines = array("<h3 id=\"page-details-$field\">$label</h3>");
        if (is_array($content)) {
            $lines[] = "<ul>";
            foreach ($content as $item) {
                $lines[] = "<li>" . $this->renderHelper($field, $item) . "</li>";
            }
            $lines[] = "</ul>";
        } else {
            $lines[] = "<p>" . $this->renderHelper($field, $content) . "</p>";
        }
        return implode("\n", $lines) . "\n";
    }

    public function renderHelper($field, $item)
    {
        $euk_facetable = EUK_FACETABLE;
        $euk_requires_capitalization = EUK_REQUIRES_CAPITALIZATION;

        if ($field === 'id') {
            $item = "https://exploreuk.uky.edu/catalog/$item";
        }
        if (in_array($field, $euk_requires_capitalization)) {
            $item = ucfirst($item);
        }

        if (strpos($item, 'http') === 0) {
            return $this->renderLink($item, $item, true);
        } elseif (in_array($field, $euk_facetable)) {
            $link = "/?f%5B$field%5D%5B%5D=";
            return $this->renderLink($this->path($link . urlencode($item)), $item, true);
        } else {
            return $item;
        }
    }

    public function renderLink($href, $text, $external = false)
    {
        return "<a href=\"$href\" " .
            ($external ? "target=\"_blank\" rel=\"noopener\"" : '') .
            ">$text</a>";
    }

    public function path($path)
    {
        $base = $this->metadata['base'];
        $url = str_replace('//', '/', "$base$path");
        $url = preg_replace('/\?$/', '', $url);
        if (strpos($url, '/') !== 0) {
            $url = "/$url";
        }
        return $url;
    }

    public function themePath($path)
    {
        return $this->path('/themes/' . $this->metadata['theme'] . "/$path");
    }

    public function subresourceIntegrity($path)
    {
        $base = $this->metadata['base'];
        $file_path = realpath(EUK_BASE_DIR) . $this->themePath($path);
        $algo = 'sha384';
        $version = $algo . '-' . base64_encode(hash($algo, file_get_contents($file_path), true));
        return $version;
    }
}
