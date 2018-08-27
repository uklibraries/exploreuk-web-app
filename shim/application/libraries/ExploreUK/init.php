<?php
namespace ExploreUK;

define('EUK_BACK_TO_SEARCH_TEXT', 'Back to Search Results');
define('EUK_DETAIL_FIELD_ORDER', array(
    'usage_display',
    'accession_number_s',
    'container_list_s',
    'contributor_s',
    'coverage_display',
    'subject_topic_facet',
    'publisher_display',
    'format',
    'id',
    'finding_aid_url_s',
    'mets_url_display',
));
define('EUK_FACETABLE', array(
    'source_s',
    'subject_topic_facet',
    'format',
    'pub_date',
));
define('EUK_FACETS', array('format', 'pub_date', 'source_s'));
define('EUK_HIT_FIELDS', array(
    'title' => 'title_display',
    'thumb' => 'thumbnail_url_s',
    'source' => 'source_s',
    'pubdate' => 'pub_date',
    'format' => 'format',
));
define('EUK_LOCALE', array(
    'en' => array(
        'accession_number_s' => 'Accession Number',
        'author_display' => 'Creator',
        'container_list_s' => 'Containers',
        'contributor_s' => 'Contributor',
        'coverage_display' => 'Geographic Subject',
        'description_display' => 'Description',
        'facet_menu_title' => 'Filter Your Results',
        'finding_aid_url_s' => 'XML Collection Guide',
        'format' => 'Format',
        'id' => 'Permalink',
        'language_display' => 'Language',
        'mets_url_display' => 'XML Metadata',
        'pub_date' => 'Date',
        'publisher_display' => 'Publisher',
        'collection_url' => 'Collection',
        'source_s' => 'Collection',
        'subject_topic_facet' => 'Library of Congress Subject Headings',
        'usage_display' => 'Rights',
        'open_collection_guide' => 'collection guide',
        'more_items' => 'more from this collection',
    ),
));
define('EUK_MAX_LABEL', 80);
define('EUK_PER_PAGE_OPTS', array(20, 50, 100));
define('EUK_REQUIRES_CAPITALIZATION', array(
    'language_display',
));
define('EUK_RESULT_DROP_FIELDS', array(
    'format',
));
define('EUK_RESULT_FACET_ORDER', array(
    'source',
    'pubdate',
    'format',
));
define('EUK_TEMPLATE_DIR', dirname(__FILE__) . '/templates');
define('EUK_TITLE_FIELD_ORDER', array(
    'pub_date',
    'author_display',
    'language_display',
    'collection_url', # NOTE: this implies source_s
    'description_display',
));

require_once('Oai.php');
require_once('OmekaShim.php');
require_once('Query.php');
require_once('View.php');

class ExploreUK
{
    private $config;
    private $omeka;

    public function __construct()
    {
        $this->omeka = new OmekaShim();
        $this->config = array(
            'base' => '',
            'theme' => 'omeukaprologue', # XXX: don't hardcode this,
        );
        if (realpath(EUK_BASE_DIR) !== realpath($_SERVER['DOCUMENT_ROOT'])) {
            $this->config['base'] = basename(EUK_BASE_DIR) . '/';
        }
    }

    private function configure()
    {
        $this->config['solr'] = $this->omeka->getThemeOption('euk_solr');
        $this->config['query'] = new Query(array(), $this->config['solr']);
        $this->config['fa_base'] = $this->omeka->getThemeOption('euk_findingaid_base_url');
        $this->config['logo'] = $this->omeka->getThemeOption('logo');
        $this->config['simple_pages'] = $this->omeka->getSimplePages();
    }

    public function run()
    {
        $this->configure();
        if (isset($_SERVER['HTTP_HOST'])) {
            $this->config['host'] = $_SERVER['HTTP_HOST'];
        } else {
            $this->config['host'] = $_SERVER['SERVER_NAME'];
        }

        $request_uri = strtok($_SERVER['REQUEST_URI'], '?');
        $query_string = $_SERVER['QUERY_STRING'];

        $base = $this->config['base'];
        if (preg_match("#^/{$base}(catalog/)?(?<slug>[^/]+)/?#", $request_uri, $matches)) {
            $slug = $matches['slug'];
            foreach ($this->config['simple_pages'] as $page) {
                if ($page->slug === $slug) {
                    return $this->simplePage($page);
                }
            }
        }

        if (preg_match("#^/{$base}catalog/oai?#", $request_uri, $matches)) {
            $oai = new Oai($this->config);
            $oai->run();
        } elseif (preg_match("#^/{$base}catalog/(?<id>[^/]+)/find/?#", $request_uri, $matches)) {
            $this->find($matches['id']);
        } elseif (preg_match("#^/{$base}catalog/(?<id>[^/]+)/download/?#", $request_uri, $matches)) {
            $this->download($matches['id']);
        } elseif (preg_match("#^/{$base}catalog/(?<id>[^/]+)/paged/?#", $request_uri, $matches)) {
            $this->embedPagedViewer($matches['id']);
        } elseif (preg_match("#^/{$base}catalog/(?<id>[^/]+)/text/?#", $request_uri, $matches)) {
            $this->text($matches['id']);
        } elseif (preg_match("#^/{$base}catalog/(?<id>[^/]+)/zoom/?#", $request_uri, $matches)) {
            $this->zoomViewer($matches['id']);
        } elseif (preg_match("#^/{$base}catalog/(?<id>[^/]+)/?#", $request_uri, $matches)) {
            $this->pageViewer($matches['id']);
        } elseif (preg_match("#^/{$base}catalog/?#", $request_uri, $matches)) {
            $this->index();
        } elseif (preg_match("#^/{$base}text/(?<id>[^/]+)/?#", $request_uri, $matches)) {
            $this->text($matches['id']);
        } else {
            $this->index();
        }
    }

    public function document($id)
    {
        $pieces = array();
        $pieces[] = 'fq=' . urlencode("id:$id");
        $pieces[] = 'fl=' . urlencode("*");
        $pieces[] = 'wt=json';
        $query = implode('&', $pieces);
        $url = $this->config['solr'] . '?' . $query;
        $result = json_decode(file_get_contents($url), true);
        if (isset($result['response']) and count($result['response']['docs']) > 0) {
            return $result['response']['docs'][0];
        } else {
            return null;
        }
    }

    public function pages($id)
    {
        $parent = preg_replace('/_[^_]+$/', '', $id);
        $pieces = array();
        $pieces[] = 'fq=' . urlencode("parent_id_s:$parent");
        $pieces[] = 'wt=json';
        $pieces[] = 'fl=' . urlencode('id,reference_image_url_s,reference_image_width_s,reference_image_height_s');
        $pieces[] = 'rows=10000';
        $pieces[] = 'sort=browse_key_sort+asc';
        $query = implode('&', $pieces);
        $url = $this->config['solr'] . '?' . $query;
        $result = json_decode(file_get_contents($url), true);
        if (isset($result['response']) and count($result['response']['docs']) > 0) {
            return $result['response']['docs'];
        } else {
            return null;
        }
    }

    public function find($id)
    {
        $euk_solr = $this->config['solr'];

        parse_str($_SERVER['QUERY_STRING'], $params);
        $q = null;
        foreach ($params as $key => $value) {
            if ($key === 'q') {
                $q = $value;
                break;
            }
        }

        $pieces = array();
        $pieces[] = 'q=' . urlencode($q);
        $pieces[] = 'fq=' . urlencode("parent_id_s:$id");
        $pieces[] = 'wt=json';
        $pieces[] = 'rows=10000';
        $pieces[] = 'fl=' . urlencode('id,reference_image_url_s,reference_image_width_s,reference_image_height_s,text_s,sequence_number_display');

        $url = "$euk_solr?" . implode('&', $pieces);
        $result = json_decode(file_get_contents($url), true);

        $response = array(
            'q' => $q,
            'matches' => array(),
        );

        if (isset($result['response']) && (count($result['response']['docs']) > 0)) {
            foreach ($result['response']['docs'] as $doc) {
                if (isset($doc['text_s'])) {
                    $snippet = euk_highlight_snippet($doc['text_s'][0], $q, 5);
                    if (strlen($snippet) > 5) {
                        $response['matches'][] = array(
                            'text' => $snippet,
                            'par' => array(array(
                                'boxes' => array(),
                                'page' => intval($doc['sequence_number_display'][0]),
                                'page_width' => intval($doc['reference_image_width_s'][0]),
                                'page_height' => intval($doc['reference_image_height_s'][0]),
                                'page_image' => $doc['reference_image_url_s'][0],
                            )),
                        );
                    }
                }
            }
        }

        header("Content-Type: application/json\n");
        print json_encode($response);
    }

    public function download($id)
    {
        if (!isset($_GET['type'])) {
            return;
        }

        switch ($_GET['type']) {
            case 'jpeg':
                $field = 'reference_image_url_s';
                $mime = 'image/jpeg';
                break;
            case 'pdf':
                $field = 'pdf_url_display';
                $mime = 'application/pdf';
                break;
            default:
                return;
        }

        $doc = $this->document($id);

        $url = $doc[$field];
        if (is_array($url)) {
            $url = $url[0];
        }

        /* TODO: maybe have a metadata-determined filename? */
        $name = basename($url);

        header("Content-type: $mime");
        header("Content-Disposition: attachment; filename=\"$name\"");

        /* TODO: maybe stream this instead */
        readfile($url);
    }

    public function text($id)
    {
        $doc = $this->document($id);
        $text_field = 'text_s';

        if (array_key_exists($text_field, $doc)) {
            print '<pre>' . implode("\n", $doc[$text_field]) . "</pre>\n";
        }
    }

    public function getVisiblePages($pages)
    {
        $visiblePages = array();
        foreach ($pages as $page) {
            if ($page['visible']) {
                $newPage = array();
                $newPage['label'] = $page['label'];
                $newPage['uri'] = $page['uri'];
                if ($page['uri'] === '/') {
                    $newPage['suppress'] = true;
                } elseif (substr($page['uri'], 0, 1) !== '/') {
                    $newPage['external'] = true;
                }
                $subPages = $this->getVisiblePages($page['pages']);
                if (count($subPages) > 0) {
                    $newPage['pages'] = $subPages;
                    $newPage['active'] = true;
                }
                $visiblePages[] = $newPage;
                $subPages = array();
            }
        }
        return $visiblePages;
    }

    public function embedPagedViewer($id)
    {
        $metadata = array(
            'base' => $this->config['base'],
            'logo' => $this->config['logo'],
            'front_page' => false,
            'page_title' => 'ExploreUK - rare and unique research materials from UK Libraries.',
            'theme' => $this->config['theme'],
            'query' => $this->config['query'],
        );
        $metadata['page_description'] = $metadata['page_title'];

        $pages = $this->pages($id);
        if ($pages) {
            $parent = preg_replace('/_[^_]+$/', '', $id);
            $sequence = intval(preg_replace('/.*[^_]+_/', '', $id)) - 1;
            $search_host = 'https://' . $_SERVER['HTTP_HOST'] . '/catalog/' . $parent . '/find';
            $images_base_url = 'https://' . $_SERVER['HTTP_HOST'] . '/themes/' . $metadata['theme'] . '/BookReader/images/';

            $metadata['script'] = array(
                'json' => json_encode($pages),
                'search_host' => json_encode($search_host),
                'imagesBaseURL' => json_encode($images_base_url),
                'query' => json_encode($metadata['query']->q('q')),
            );
        }

        $view = new View($metadata, 'paged');
        $view->render();
    }

    public function zoomViewer($id)
    {
        $doc = $this->document($id);
        $format = $doc['format'];
        if ($format === 'collections') {
            header('Location: ' . $this->config['fa_base'] . $id);
            return;
        }

        $metadata = array(
            'id' => $id,
            'logo' => $this->config['logo'],
            'action' => 'zoom',
            'base' => $this->config['base'],
            'front_page' => false,
            'theme' => $this->config['theme'],
            'query' => $this->config['query'],
        );

        $metadata['page_title'] = 'foo';
        $metadata['page_description'] = $metadata['page_title'];
        $metadata['search_link'] = $this->config['solr'] . '?' . $metadata['query']->searchParams();
        $metadata['back_to_search'] = $this->path('/catalog/' . $metadata['query']->link());
        $metadata['back_to_search_text'] = EUK_BACK_TO_SEARCH_TEXT;

        $flat = array();
        foreach ($doc as $key => $value) {
            # XXX: Consider adding $euk_repeatable_fields to config.
            if ($key === 'subject_topic_facet') {
                $flat[$key] = $value;
            } elseif (is_array($value) and count($value) > 0) {
                $flat[$key] = $value[0];
            } elseif (isset($value)) {
                $flat[$key] = $value;
            } else {
                $flat[$key] = '';
            }
        }
        $details = array();
        $pageMetadata = array();
        $desired = array(
            array('Title', 'title_display'),
            array('Creator', 'author_display'),
            array('Format', 'format'),
            array('Publication date', 'pub_date'),
            array('Date uploaded', 'date_digitized_display'),
            array('Language', 'language_display'),
            array('Publisher', 'publisher_display'),
            array('Type', 'type_display'),
            array('Accession number', 'accession_number_display'),
            array('Source', 'source_s'),
            array('Coverage', 'coverage_s'),
            array('Finding aid', 'finding_aid_url_s'),
            array('Metadata record', 'mets_url_display'),
            array('Rights', 'usage_display'),
        );
        foreach ($desired as $row) {
            $label = $row[0];
            $key = $row[1];
            $link = false;
            if ($key === 'type_display') {
                $value = type_for($doc['format'], $doc['type_display']);
            } else {
                if (isset($doc[$key])) {
                    $value = $doc[$key];
                } else {
                    $value = false;
                }
            }
            if ($key === 'finding_aid_url_s' or $key === 'mets_url_display') {
                $link = true;
            }
            if ($value) {
                $details[$key] = array(
                    'label' => $label,
                    'key' => $key,
                    'value' => $value,
                    'link' => $link,
                );
            }
        }
        $details['id'] = array(
            'label' => 'Permalink',
            'key' => 'id',
            'value' => $id,
        );

        $metadata['page_title'] = brevity(htmlspecialchars($doc['title_display']));
        if (array_key_exists('finding_aid_url_s', $doc)) {
            $entry = array(
                'label' => 'Collection guide',
                'anchor' => true,
                'key' => 'collection_guide',
                'value' => $this->path('/catalog/' . $doc['object_id_s'][0] . $metadata['query']->link()),
                'link' => true,
            );
            $details['collection_guide'] = $entry;
            $metadata['page_description'] = htmlspecialchars(
                $doc['title_display'] . ', ' .
                implode(', ', $doc['source_s']) . ', ' .
                'University of Kentucky Libraries - ExploreUK',
                ENT_QUOTES,
                'UTF-8'
            );
        } else {
            $metadata['page_description'] = htmlspecialchars(
                $doc['title_display'] . ', ' .
                'University of Kentucky Libraries - ExploreUK',
                ENT_QUOTES,
                'UTF-8'
            );
        }

        switch ($format) {
            case 'audio':
                $metadata['item_audio'] = array(
                    'audio' => array(
                        'href_id' => "audio_$id",
                        'href' => $flat['reference_audio_url_s'],
                    ),
                );
                $metadata['script_media'] = true;
                break;
            case 'audiovisual':
                $metadata['item_audio'] = array(
                    'video' => array(
                        'href_id' => "video_$id",
                        'href' => $flat['reference_video_url_s'],
                    ),
                );
                $metadata['script_media'] = true;
                break;
            case 'drawings (visual works)':
                /* fall through */
            case 'images':
                $metadata['item_image'] = $flat;
                $metadata['script_image'] = array(
                    'osd_id' => 'viewer',
                    'prefix_url' => $this->themePath('openseadragon/images/'),
                    'ref_id' => 'reference_image',
                );
                $metadata['downloadable'] = true;
                break;
            case 'annual reports':
                /* fall through */
            case 'architectural drawings (visual works)':
                /* fall through */
            case 'archival material':
                /* fall through */
            case 'athletic publications':
                /* fall through */
            case 'booklets':
                /* fall through */
            case 'books':
                /* fall through */
            case 'course catalogs':
                /* fall through */
            case 'directories':
                /* fall through */
            case 'indexes (reference sources)':
                /* fall through */
            case 'journals':
                /* fall through */
            case 'ledgers':
                /* fall through */
            case 'maps':
                /* fall through */
            case 'minutes':
                /* fall through */
            case 'newsletters':
                /* fall through */
            case 'newspapers':
                /* fall through */
            case 'yearbooks':
                $flat['embed_url'] = $this->path("/catalog/$id/paged" . $metadata['query']->link());
                $text_field = 'text_s';
                if (array_key_exists($text_field, $doc)) {
                    $flat['text'] = array(
                        'href' => $this->path("/catalog/$id/text"),
                    );
                }
                $metadata['item_book'] = $flat;
                $metadata['downloadable'] = true;
                break;
            default:
                $pieces = array();
                foreach ($doc as $field => $value) {
                    if (is_array($value)) {
                        $value = implode('; ', $value);
                    }
                    $pieces[] = "<b>$field</b>: $value";
                }
                $metadata['item'] = '<ul><li>' . implode('</li><li>', $pieces) . "</li></ul>\n";
                break;
        }

        $metadata['flat'] = $flat;
        $metadata['details'] = $details;

        $raw_pages = json_decode($this->omeka->getOption('public_navigation_main'), true);
        $metadata['nav'] = $this->getVisiblePages($raw_pages);
        $view = new View($metadata, 'zoom');
        $view->render();
    }

    public function pageViewer($id)
    {
        $doc = $this->document($id);
        $format = $doc['format'];
        if ($format === 'collections') {
            header('Location: ' . $this->config['fa_base'] . $id);
            return;
        }

        $metadata = array(
            'id' => $id,
            'logo' => $this->config['logo'],
            'action' => 'page',
            'base' => $this->config['base'],
            'front_page' => false,
            'theme' => $this->config['theme'],
            'query' => $this->config['query'],
        );

        $metadata['search_link'] = $this->config['solr'] . '?' . $metadata['query']->searchParams();
        $metadata['back_to_search'] = $this->path('/catalog/' . $metadata['query']->link());
        $metadata['back_to_search_text'] = EUK_BACK_TO_SEARCH_TEXT;

        $flat = array();
        foreach ($doc as $key => $value) {
            # XXX: Consider adding $euk_repeatable_fields to config.
            if ($key === 'subject_topic_facet') {
                $flat[$key] = $value;
            } elseif (is_array($value) and count($value) > 0) {
                $flat[$key] = $value[0];
            } elseif (isset($value)) {
                $flat[$key] = $value;
            } else {
                $flat[$key] = '';
            }
        }
        $details = array();
        $pageMetadata = array();
        $desired = array(
            array('Title', 'title_display'),
            array('Creator', 'author_display'),
            array('Format', 'format'),
            array('Publication date', 'pub_date'),
            array('Date uploaded', 'date_digitized_display'),
            array('Language', 'language_display'),
            array('Publisher', 'publisher_display'),
            array('Type', 'type_display'),
            array('Accession number', 'accession_number_display'),
            array('Source', 'source_s'),
            array('Coverage', 'coverage_s'),
            array('Finding aid', 'finding_aid_url_s'),
            array('Metadata record', 'mets_url_display'),
            array('Rights', 'usage_display'),
        );
        foreach ($desired as $row) {
            $label = $row[0];
            $key = $row[1];
            $link = false;
            if ($key === 'type_display') {
                $value = type_for($doc['format'], $doc['type_display']);
            } else {
                if (isset($doc[$key])) {
                    $value = $doc[$key];
                } else {
                    $value = false;
                }
            }
            if ($key === 'finding_aid_url_s' or $key === 'mets_url_display') {
                $link = true;
            }
            if ($value) {
                $details[$key] = array(
                    'label' => $label,
                    'key' => $key,
                    'value' => $value,
                    'link' => $link,
                );
            }
        }
        $details['id'] = array(
            'label' => 'Permalink',
            'key' => 'id',
            'value' => $id,
        );

        $metadata['page_title'] = brevity(htmlspecialchars($doc['title_display']));
        if (array_key_exists('finding_aid_url_s', $doc)) {
            $entry = array(
                'label' => 'Collection guide',
                'anchor' => true,
                'key' => 'collection_guide',
                'value' => $this->path('/catalog/' . $doc['object_id_s'][0] . $metadata['query']->link()),
                'link' => true,
            );
            $details['collection_guide'] = $entry;
            $metadata['page_description'] = htmlspecialchars(
                $doc['title_display'] . ', ' .
                implode(', ', $doc['source_s']) . ', ' .
                'University of Kentucky Libraries - ExploreUK',
                ENT_QUOTES,
                'UTF-8'
            );
        } else {
            $metadata['page_description'] = htmlspecialchars(
                $doc['title_display'] . ', ' .
                'University of Kentucky Libraries - ExploreUK',
                ENT_QUOTES,
                'UTF-8'
            );
        }

        switch ($format) {
            case 'audio':
                $metadata['item_audio'] = array(
                    'audio' => array(
                        'href_id' => "audio_$id",
                        'href' => $flat['reference_audio_url_s'],
                    ),
                );
                $metadata['script_media'] = true;
                break;
            case 'audiovisual':
                $metadata['item_audio'] = array(
                    'video' => array(
                        'href_id' => "video_$id",
                        'href' => $flat['reference_video_url_s'],
                    ),
                );
                $metadata['script_media'] = true;
                break;
            case 'drawings (visual works)':
                /* fall through */
            case 'images':
                $metadata['item_image'] = $flat;
                $metadata['script_image'] = array(
                    'osd_id' => 'viewer',
                    'prefix_url' => $this->themePath('openseadragon/images/'),
                    'ref_id' => 'reference_image',
                );
                $metadata['downloadable'] = true;
                break;
            case 'annual reports':
                /* fall through */
            case 'architectural drawings (visual works)':
                /* fall through */
            case 'archival material':
                /* fall through */
            case 'athletic publications':
                /* fall through */
            case 'booklets':
                /* fall through */
            case 'books':
                /* fall through */
            case 'course catalogs':
                /* fall through */
            case 'directories':
                /* fall through */
            case 'indexes (reference sources)':
                /* fall through */
            case 'journals':
                /* fall through */
            case 'ledgers':
                /* fall through */
            case 'maps':
                /* fall through */
            case 'minutes':
                /* fall through */
            case 'newsletters':
                /* fall through */
            case 'newspapers':
                /* fall through */
            case 'yearbooks':
                $flat['embed_url'] = $this->path("/catalog/$id/paged" . $metadata['query']->link());
                $text_field = 'text_s';
                if (array_key_exists($text_field, $doc)) {
                    $flat['text'] = array(
                        'href' => $this->path("/catalog/$id/text"),
                    );
                }
                $metadata['item_book'] = $flat;
                $metadata['downloadable'] = true;
                break;
            default:
                $pieces = array();
                foreach ($doc as $field => $value) {
                    if (is_array($value)) {
                        $value = implode('; ', $value);
                    }
                    $pieces[] = "<b>$field</b>: $value";
                }
                $metadata['item'] = '<ul><li>' . implode('</li><li>', $pieces) . "</li></ul>\n";
                break;
        }

        $metadata['flat'] = $flat;
        $metadata['details'] = $details;

        $raw_pages = json_decode($this->omeka->getOption('public_navigation_main'), true);
        $metadata['nav'] = $this->getVisiblePages($raw_pages);
        $metadata['z_simple_pages'] = $this->config['simple_pages'];
        $view = new View($metadata, 'page');
        $view->render();
    }

    public function index()
    {
        $raw_pages = json_decode($this->omeka->getOption('public_navigation_main'), true);
        $metadata = array(
            'base' => $this->config['base'],
            'logo' => $this->config['logo'],
            'theme' => $this->config['theme'],
            'query' => $this->config['query'],
            'nav' => $this->getVisiblePages($raw_pages),
        );

        $metadata['q'] = $metadata['query']->q('q');
        $metadata['search_link'] = $this->config['solr'] . '?' . $metadata['query']->searchParams();
        $metadata['back_to_search'] = $this->path('/catalog/' . $metadata['query']->link());
        if ($this->config['query']->nontrivial()) {
            $result = $this->config['query']->search();
            $metadata['page_title'] = htmlspecialchars($metadata['q'], ENT_QUOTES, 'UTF-8') . ' - ExploreUK';

            # Facets
            $metadata['active_facets'] = array();
            foreach ($metadata['query']->q('f') as $f_term => $value) {
                $remove_link = $metadata['query']->removeFilterLink($f_term, $value);
                $field_label = facet_displayname($f_term);
                if (isset($result['facet_counts']['facet_fields'][$f_term])) {
                    $facet_counts = $result['facet_counts']['facet_fields'][$f_term];
                    $count = 0;
                    if (count($facet_counts) > 0) {
                        $navs = navsHashFromFlatList($facet_counts);
                        $count = $navs[$value];
                    }
                    $metadata['active_facets'][] = array(
                        'field_label' => $field_label,
                        'remove_link' => $this->path('/catalog/' . $remove_link),
                        'field_raw' => $f_term,
                        'value_label' => $value,
                        'count' => $count,
                    );
                }
            }

            $metadata['facets'] = array();
            $facets = EUK_FACETS;
            foreach ($facets as $facet) {
                $facet_counts = $result['facet_counts']['facet_fields'][$facet];
                if (count($facet_counts) > 2) {
                    $navs = navsHashFromFlatList($facet_counts);
                    $values = array();
                    foreach ($navs as $label => $count) {
                        $add_link = $metadata['query']->addFilterLink($facet, $label);
                        $values[] = array(
                            'add_link' => $this->path('/catalog/' . $add_link),
                            'value_label' => $label,
                            'count' => $count,
                        );
                    }
                    $metadata['facets'][] = array(
                        'field_label' => facet_displayname($facet),
                        'values' => $values,
                        'field_raw' => $facet,
                    );
                }
            }

            $metadata['facet_full_lists'] = array();
            $facets_by_count = $metadata['query']->getFacetsByCount();
            $facets_by_index = $metadata['query']->getFacetsByIndex();
            foreach ($facets as $facet) {
                $metadata['facet_full_lists'][$facet] = array(
                    'field_label' => facet_displayname($facet),
                    'field_raw' => $facet,
                    'by-count' => array(),
                    'by-index' => array(),
                );

                $facet_counts = $facets_by_count['facet_counts']['facet_fields'][$facet];
                if (count($facet_counts) > 2) {
                    $navs = navsHashFromFlatList($facet_counts);
                    foreach ($navs as $label => $count) {
                        $add_link = $metadata['query']->addFilterLink($facet, $label);
                        $metadata['facet_full_lists'][$facet]['by-count'][] = array(
                            'add_link' => $this->path('/catalog/' . $add_link),
                            'value_label' => $label,
                            'count' => $count,
                        );
                    }
                }

                $facet_counts = $facets_by_index['facet_counts']['facet_fields'][$facet];
                if (count($facet_counts) > 2) {
                    $navs = navsHashFromFlatList($facet_counts);
                    foreach ($navs as $label => $count) {
                        $add_link = $metadata['query']->addFilterLink($facet, $label);
                        $metadata['facet_full_lists'][$facet]['by-index'][] = array(
                            'add_link' => $this->path('/catalog/' . $add_link),
                            'value_label' => $label,
                            'count' => $count,
                        );
                    }
                }
            }
        } else {
            $metadata['page_title'] = 'ExploreUK - rare and unique research materials from UK Libraries.';
        }
        $metadata['page_description'] = $metadata['page_title'];

        if (preg_match('/^\/(catalog\/?)?$/', $_SERVER['REQUEST_URI'])) {
            $metadata['front_page'] = true;
            $metadata['search_items_count_text'] = $this->omeka->getThemeOption('search_items_count_text');

            $colln = $this->omeka->getCollectionByTitle('Background image rotation');
            $metadata['colln'] = $colln;
            $items = $this->omeka->getItems($colln->id, true);
            if (count($items) > 0) {
                $index = array_rand($items);
                $item = $items[$index];
                $metadata['featured_image'] = $this->omeka->getItemMetadata($item->id);
            } else {
                $metadata['featured_image'] = array(
                    'image' => '',
                    'label' => '',
                    'url' => '',
                );
            }

            $metadata['popular_resources'] = array();
            $colln = $this->omeka->getCollectionByTitle('Popular Resources');
            $items = $this->omeka->getItems($colln->id);
            foreach ($items as $item) {
                $metadata['popular_resources'][] = $this->omeka->getItemMetadata($item->id);
            }

            $metadata['additional_resources'] = array();
            $colln = $this->omeka->getCollectionByTitle('Additional Resources');
            $items = $this->omeka->getItems($colln->id);
            foreach ($items as $item) {
                $metadata['additional_resources'][] = $this->omeka->getItemMetadata($item->id);
            }
            $view = new View($metadata, 'front-page');
        } else {
            # Pagination and results
            $metadata['facet_menu_title'] = EUK_LOCALE['en']['facet_menu_title'];
            $metadata['front_page'] = false;
            $metadata['pagination'] = array();
            $metadata['results'] = array();
            if (intval($result['response']['numFound']) > 0) {
                #pagination
                $pagination_data = array(
                    'first' => $metadata['query']->q('offset') + 1,
                    'last' => $metadata['query']->q('offset') + $metadata['query']->q('rows'),
                    'count' => $result['response']['numFound'],
                );
                if ($metadata['query']->q('offset') > 0) {
                    $pagination_data['previous'] = $this->path('/catalog/' . $metadata['query']->previousLink());
                }
                if ($pagination_data['last'] <= $pagination_data['count']) {
                    $pagination_data['next'] = $this->path('/catalog/' . $metadata['query']->nextLink());
                } else {
                    $pagination_data['last'] = $pagination_data['count'];
                }
                $metadata['pagination'] = $pagination_data;

                # results
                $docs = $result['response']['docs'];
                $results = array();
                for ($i = 0; $i < count($docs); $i++) {
                    $results_data = array();
                    # raw to begin
                    foreach (EUK_HIT_FIELDS as $field => $solr_field) {
                        $raw_field = null;
                        if (isset($docs[$i][$solr_field])) {
                            $raw_field = $docs[$i][$solr_field];
                            if (is_array($raw_field)) {
                                $results_data[$field] = htmlspecialchars($raw_field[0], ENT_QUOTES, 'UTF-8');
                            } else {
                                $results_data[$field] = htmlspecialchars($raw_field, ENT_QUOTES, 'UTF-8');
                            }
                        }
                    }
                    # cleanup
                    if (isset($results_data['thumb'])) {
                        $results_data['thumb'] = str_replace('http:', 'https:', $results_data['thumb']);
                        $results_data['thumb'] = str_replace('_tb.jpg', '_ftb.jpg', $results_data['thumb']);
                    }
                    $results_data['link'] = $this->path('/catalog/' . $docs[$i]['id'] . $metadata['query']->link());
                    $results_data['number'] = $metadata['query']->q('offset') + $i + 1;
                    if ($results_data['format'] === 'collections') {
                        $results_data['target'] = ' target="_blank" rel="noopener"';
                    }
                    $results[] = $results_data;
                }
                $metadata['results'] = $results;
                $view = new View($metadata, 'search-results');
            } else {
                $metadata['suggestions'] = array();
                foreach ($result['spellcheck']['suggestions'] as $word) {
                    if (isset($word['suggestion'])) {
                        foreach ($word['suggestion'] as $suggestion) {
                            $metadata['suggestions'][] = $suggestion['word'];
                        }
                    }
                }
                $view = new View($metadata, 'no-results');
            }
        }

        $view->render();
    }

    public function path($path)
    {
        $base = $this->config['base'];
        $url = str_replace('//', '/', "$base$path");
        $url = preg_replace('/\?$/', '', $url);
        if (strpos($url, '/') !== 0) {
            $url = "/$url";
        }
        return $url;
    }

    public function themePath($path)
    {
        return $this->path('/themes/' . $this->config['theme'] . "/$path");
    }

    public function simplePage($page)
    {
        $raw_pages = json_decode($this->omeka->getOption('public_navigation_main'), true);
        $metadata = array(
            'action' => 'simple-page',
            'logo' => $this->config['logo'],
            'front_page' => false,
            'base' => $this->config['base'],
            'theme' => $this->config['theme'],
            'query' => $this->config['query'],
            'nav' => $this->getVisiblePages($raw_pages),
        );
        $metadata['page'] = $this->omeka->getSimplePage($page->id);
        $metadata['page_title'] = $metadata['page']->title;
        $metadata['page_description'] = $metadata['page']->title;

        $view = new View($metadata, 'simple-page');
        $view->render();
    }
}

/* helper functions */

function type_for($format, $type)
{
    $type_for = array(
        'archival material' => 'collection',
        'athletic publications' => 'text',
        'books' => 'text',
        'collections' => 'collection',
        'course catalogs' => 'text',
        'directories' => 'text',
        'images' => 'image',
        'journals' => 'text',
        'ledgers' => 'text',
        'maps' => 'image',
        'minutes' => 'text',
        'newspapers' => 'text',
        'oral histories' => 'sound',
        'scrapbooks' => array('text', 'image'),
        'theses' => 'text',
        'yearbooks' => array('text', 'image'),
    );
    if (array_key_exists($format, $type_for)) {
        return $type_for[$format];
    } else {
        return $type;
    }
}

function brevity($message, $length = 0)
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

function facet_displayname($facet)
{
    $euk_locale = EUK_LOCALE;
    if (isset($euk_locale['en'][$facet])) {
        return ucfirst($euk_locale['en'][$facet]);
    } else {
        return 'unknown';
    }
}

function navsHashFromFlatList($navs)
{
    $hash = array();
    for ($i = 0; $i < count($navs); $i += 2) {
        $hash[$navs[$i]] = $navs[$i + 1];
    }
    return $hash;
}
