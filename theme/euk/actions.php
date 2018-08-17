<?php

define('EUK_MAX_LABEL', 80);

function subresource_integrity($path)
{
    global $euk_base;
    global $theme_path;
    $theme_name = Theme::getCurrentThemeName('public');
    $file_path = realpath(BASE_DIR) . "$euk_base/themes/$theme_name/$path";
    $algo = 'sha384';
    $version = $algo . '-' . base64_encode(hash($algo, file_get_contents($file_path), true));
    return $version;
}

function render_field($field, $content)
{
    global $euk_locale;
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
                render_link(u("/catalog/{$content['base_id']}"), $collection_label, true),
                ' | ',
                render_link(u($link . urlencode($content['source_s'])), $link_label, true),
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
            $lines[] = "<li>" . render_field_helper($field, $item) . "</li>";
        }
        $lines[] = "</ul>";
    } else {
        $lines[] = "<p>" . render_field_helper($field, $content) . "</p>";
    }
    return implode("\n", $lines) . "\n";
}

function render_field_helper($field, $item)
{
    global $euk_facetable;
    global $euk_requires_capitalization;

    if ($field === 'id') {
        $item = "https://exploreuk.uky.edu/catalog/$item";
    }
    if (in_array($field, $euk_requires_capitalization)) {
        $item = ucfirst($item);
    }

    if (strpos($item, 'http') === 0) {
        return render_link($item, $item, true);
    } elseif (in_array($field, $euk_facetable)) {
        $link = "/?f%5B$field%5D%5B%5D=";
        return render_link(u($link . urlencode($item)), $item);
    } else {
        return $item;
    }
}

function render_link($href, $text, $external = false)
{
    return "<a href=\"$href\" " .
           ($external ? "target=\"_blank\" rel=\"noopener\"" : '') .
           ">$text</a>";
}

function euk_brevity($message, $length = 0)
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

function m($arg)
{
    global $euk_data;
    if (isset($euk_data[$arg])) {
        return $euk_data[$arg];
    } else {
        return false;
    }
}

function meta($arg)
{
    global $findaidurl;
    if ($arg === 'collection_url') {
        return array(
            'base_id' => meta_raw('object_id_s'),
            'source_s' => meta_raw('source_s'),
        );
    } else {
        return meta_raw($arg);
    }
}

function meta_raw($arg)
{
    global $euk_data;
    $r = null;
    $sources = array(
        'item_audio',
        'item_image',
        'item_book',
    );
    foreach ($sources as $source) {
        if (m($source)) {
            $r = m($source);
            break;
        }
    }
    if ($r && isset($r[$arg])) {
        return $r[$arg];
    } else {
        return false;
    }
}

function q($arg)
{
    global $euk_query;
    if (isset($euk_query[$arg])) {
        return $euk_query[$arg];
    } else {
        return false;
    }
}

function euk_handle_action()
{
    global $euk_data;
    switch (euk_action()) {
        case 'oai':
            euk_oai();
            break;
        case 'index':
            euk_index();
            break;
        case 'page':
            euk_page();
            break;
        case 'zoom':
            euk_zoom();
            break;
        case 'download':
            euk_download();
            exit;
            break;
        case 'paged':
            euk_paged();
            break;
        case 'text':
            euk_text();
            break;
        default:
            print "<!-- {" . euk_action() . "} -->\n";
            $euk_data = array('action' => euk_action());
            break;
    }
}

function euk_action()
{
    parse_str($_SERVER['QUERY_STRING'], $params);
    if (isset($params['action'])) {
        return $params['action'];
    } else {
        return 'index';
    }
}

function euk_download()
{
    header("Content-type: image/jpeg");
    header("Content-Disposition: attachment; filename=\"kittens.jpg\"");
    readfile("http://placekitten.com/g/288/144");
    exit;
    global $euk_id;
    global $euk_query;
    euk_initialize_query();
    euk_initialize_id();

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

    $doc = euk_get_document($euk_id);
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

function euk_index()
{
    global $euk_data;
    global $euk_solr;
    global $site_title;
    global $hit_fields;
    global $euk_query;
    euk_initialize_query();
    $result = euk_get_search_results();

    $data = array(
        'action' => 'index',
    );

    # Search
    $data['q'] = q('q');
    $data['search_link'] = "$euk_solr?" . euk_build_search_params();
    $data['back_to_search'] = u('/catalog/' . euk_link_to_query($euk_query));

    # Title
    if (strlen($data['q']) > 0) {
        $data['page_title'] = htmlspecialchars($data['q'], ENT_QUOTES, 'UTF-8') . ' - ExploreUK';
    } else {
        $data['page_title'] = 'ExploreUK - rare and unique research materials from UK Libraries.';
    }
    $data['page_description'] = $data['page_title'];

    # Facets
    $data['active_facets'] = array();
    foreach ($euk_query['f'] as $f_term => $value) {
        $remove_link = euk_remove_filter($f_term, $value);
        $field_label = euk_facet_displayname($f_term);
        if (isset($result['facet_counts']['facet_fields'][$f_term])) {
            $facet_counts = $result['facet_counts']['facet_fields'][$f_term];
            $count = 0;
            if (count($facet_counts) > 0) {
                $navs_sensible = euk_makeNavsSensible($facet_counts);
                $count = $navs_sensible[$value];
            }
            $data['active_facets'][] = array(
                'field_label' => $field_label,
                'remove_link' => u('/catalog/' . $remove_link),
                'field_raw' => $f_term,
                'value_label' => $value,
                'count' => $count,
            );
        }
    }

    $data['facets'] = array();
    global $facets;
    foreach ($facets as $facet) {
        $facet_counts = $result['facet_counts']['facet_fields'][$facet];
        if (count($facet_counts) > 2) {
            $navs_sensible = euk_makeNavsSensible($facet_counts);
            $values = array();
            foreach ($navs_sensible as $label => $count) {
                $add_link = euk_add_filter($facet, $label);
                $values[] = array(
                    'add_link' => u('/catalog/' . $add_link),
                    'value_label' => $label,
                    'count' => $count,
                );
            }
            $data['facets'][] = array(
                'field_label' => euk_facet_displayname($facet),
                'values' => $values,
                'field_raw' => $facet,
            );
        }
    }

    $data['facet_full_lists'] = array();
    $facets_by_count = euk_get_facets_by_count();
    $facets_by_index = euk_get_facets_by_index();
    foreach ($facets as $facet) {
        $data['facet_full_lists'][$facet] = array(
            'field_label' => euk_facet_displayname($facet),
            'field_raw' => $facet,
            'by-count' => array(),
            'by-index' => array(),
        );

        $facet_counts = $facets_by_count['facet_counts']['facet_fields'][$facet];
        if (count($facet_counts) > 2) {
            $navs_sensible = euk_makeNavsSensible($facet_counts);
            foreach ($navs_sensible as $label => $count) {
                $add_link = euk_add_filter($facet, $label);
                $data['facet_full_lists'][$facet]['by-count'][] = array(
                    'add_link' => u('/catalog/' . $add_link),
                    'value_label' => $label,
                    'count' => $count,
                );
            }
        }

        $facet_counts = $facets_by_index['facet_counts']['facet_fields'][$facet];
        if (count($facet_counts) > 2) {
            $navs_sensible = euk_makeNavsSensible($facet_counts);
            foreach ($navs_sensible as $label => $count) {
                $add_link = euk_add_filter($facet, $label);
                $data['facet_full_lists'][$facet]['by-index'][] = array(
                    'add_link' => u('/catalog/' . $add_link),
                    'value_label' => $label,
                    'count' => $count,
                );
            }
        }
    }

    # Pagination and results
    if (!euk_on_front_page()) {
        $data['on_front_page'] = false;
        $data['pagination'] = array();
        $data['results'] = array();
        if (intval($result['response']['numFound']) > 0) {
            #pagination
            $pagination_data = array(
                'first' => $euk_query['offset'] + 1,
                'last' => $euk_query['offset'] + $euk_query['rows'],
                'count' => $result['response']['numFound'],
            );
            if ($euk_query['offset'] > 0) {
                $pagination_data['previous'] = u('/catalog/' . euk_previous_link());
            }
            if ($pagination_data['last'] <= $pagination_data['count']) {
                $pagination_data['next'] = u('/catalog/' . euk_next_link());
            } else {
                $pagination_data['last'] = $pagination_data['count'];
            }
            $data['pagination'] = $pagination_data;

            # results
            $docs = $result['response']['docs'];
            $results = array();
            for ($i = 0; $i < count($docs); $i++) {
                $results_data = array();
                # raw to begin
                foreach ($hit_fields as $field => $solr_field) {
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
                $results_data['link'] = u('/catalog/' . $docs[$i]['id'] . euk_link_to_query($euk_query));
                $results_data['number'] = $euk_query['offset'] + $i + 1;
                if ($results_data['format'] === 'collections') {
                    $results_data['target'] = ' target="_blank" rel="noopener"';
                }
                $results[] = $results_data;
            }
            $data['results'] = $results;
        }
    } else {
        $data['on_front_page'] = true;
    }

    $euk_data = $data;
    return $euk_data;
}

function euk_page()
{
    global $euk_data;
    global $euk_id;
    global $euk_query;
    global $euk_solr;
    global $site_title;
    global $text_field;
    global $theme_path;
    euk_initialize_query();
    euk_initialize_id();

    $data = array(
        'action' => 'page',
    );

    # Search
    $data['q'] = q('q');
    $data['search_link'] = "$euk_solr?" . euk_build_search_params();
    $data['back_to_search'] = u('/catalog/' . euk_link_to_query($euk_query));

    $doc = euk_get_document($euk_id);
    $format = $doc['format'];
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
    $metadata = array();
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
                if (is_array($doc[$key])) {
                    $value = implode('.  ', $doc[$key]);
                } else {
                    $value = $doc[$key];
                }
            } else {
                $value = false;
            }
        }
        if ($key === 'finding_aid_url_s' or $key === 'mets_url_display') {
            $link = true;
        }
        if ($value) {
            $metadata[] = array(
                'label' => $label,
                'key' => $key,
                'value' => $value,
                'link' => $link,
            );
        }
    }

    # Title
    $data['page_title'] = euk_brevity(htmlspecialchars($doc['title_display']));

    if (array_key_exists('finding_aid_url_s', $doc)) {
        $entry = array(
            'label' => 'Collection guide',
            'anchor' => true,
            'key' => 'collection_guide',
            'value' => u('/catalog/' . $doc['object_id_s'][0] . euk_link_to_query($euk_query)),
            'link' => true,
        );
        $metadata[] = $entry;
        $data['page_description'] = htmlspecialchars(
            $doc['title_display'] . ', ' .
            implode(', ', $doc['source_s']) . ', ' .
            'University of Kentucky Libraries - ExploreUK',
            ENT_QUOTES,
            'UTF-8'
        );
    } else {
        $data['page_description'] = htmlspecialchars(
            $doc['title_display'] . ', ' .
            'University of Kentucky Libraries - ExploreUK',
            ENT_QUOTES,
            'UTF-8'
        );
    }

    $flat['metadata'] = $metadata;

    switch ($format) {
        case 'audio':
            $data['item_audio'] = array_merge(
                $flat,
                array(
                    'audio' => array(
                        'href_id' => "audio_$euk_id",
                        'href' => $flat['reference_audio_url_s'],
                    ),
                )
            );
            $data['script_media'] = true;
            $data['downloadable'] = false;
            break;
        case 'audiovisual':
            $data['item_audio'] = array_merge(
                $flat,
                array(
                    'video' => array(
                        'href_id' => "video_$euk_id",
                        'href' => $flat['reference_video_url_s'],
                    ),
                )
            );
            $data['script_media'] = true;
            $data['downloadable'] = false;
            break;
        case 'drawings (visual works)':
            /* fall through */
        case 'images':
            $data['item_image'] = $flat;
            $data['script_image'] = array_merge(
                $flat,
                array(
                    'osd_id' => 'viewer',
                    'prefix_url' => "$theme_path/openseadragon/images/",
                    'ref_id' => 'reference_image',
                )
            );
            $data['downloadable'] = true;
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
            $flat['embed_url'] = u(implode('', array(
                '/catalog/',
                $euk_id,
                '/paged',
                q('q') ? ('?q=' . urlencode(q('q'))) : '',
            )));
            if (array_key_exists($text_field, $doc)) {
                $flat['text'] = array(
                    'href' => u('/catalog/' . $euk_id . '/text'),
                );
            }
            $data['item_book'] = $flat;
            $data['downloadable'] = true;
            break;
        case 'collections':
            /* We'll want to embed this eventually */
            $target = "https://nyx.uky.edu/fa/findingaid/?id=$euk_id";
            header('Location: '. $target);
            exit;
            break;
        default:
            $pieces = array();
            foreach ($doc as $field => $value) {
                if (is_array($value)) {
                    $value = implode('; ', $value);
                }
                $pieces[] = "<b>$field</b>: $value";
            }
            $data['item'] = '<ul><li>' . implode('</li><li>', $pieces) . "</li></ul>\n";
            $url = "$euk_solr?" . document_query($euk_id);
            $data['item'] .= "<p><a href=\"$url\">$url</a></p>";
            break;
    }
    $euk_data = $data;
    return $euk_data;
}

function euk_paged()
{
    global $euk_data;
    global $euk_id;
    global $euk_query;
    global $facets;
    global $site_title;
    global $theme_path;
    euk_initialize_query();
    euk_initialize_id();

    $data = array(
        'site_title' => $site_title,
    );
    $data['action'] = 'paged';
    $data['back_to_search'] = u('/catalog/' . euk_link_to_query($euk_query));

    $doc = euk_get_document($euk_id);
    $format = $doc['format'];
    $flat = array();
    foreach ($doc as $key => $value) {
        if (is_array($value) and count($value) > 0) {
            $flat[$key] = $value[0];
        } elseif (isset($value)) {
            $flat[$key] = $value;
        } else {
            $flat[$key] = '';
        }
    }
    $metadata = array();
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
                if (is_array($doc[$key])) {
                    $value = implode('.  ', $doc[$key]);
                } else {
                    $value = $doc[$key];
                }
            } else {
                $value = false;
            }
        }
        if ($key === 'finding_aid_url_s' or $key === 'mets_url_display') {
            $link = true;
        }
        if ($value) {
            $metadata[] = array(
                'label' => $label,
                'key' => $key,
                'value' => $value,
                'link' => $link,
            );
        }
    }

    if (array_key_exists('finding_aid_url_s', $doc)) {
        $entry = array(
            'label' => 'Collection guide',
            'anchor' => true,
            'key' => 'collection_guide',
            'value' => u('/catalog/' . $doc['object_id_s'][0] . euk_link_to_query($euk_query)),
            'link' => true,
        );
        $metadata[] = $entry;
    }

    if (array_key_exists('pdf_url_display', $doc)) {
        $entry = array(
            'label' => 'PDF',
            'anchor' => true,
            'key' => 'pdf_url_display',
            'value' => $doc['pdf_url_display'][0],
            'link' => true,
        );
        $metadata[] = $entry;
    }

    if (array_key_exists('reference_image_url_s', $doc)) {
        $entry = array(
            'label' => 'Reference image',
            'anchor' => true,
            'key' => 'reference_image_url_s',
            'value' => $doc['reference_image_url_s'][0],
            'link' => true,
        );
        $metadata[] = $entry;
    }

    $flat['metadata'] = $metadata;

    $pages = euk_get_pages($euk_id);
    if ($pages) {
        $parent = preg_replace('/_[^_]+$/', '', $euk_id);
        $sequence = intval(preg_replace('/.*[^_]+_/', '', $euk_id)) - 1;
        $search_host = 'https://' . $_SERVER['HTTP_HOST'] . '/catalog/' . $parent . '/find';
        $images_base_url = 'https://' . $_SERVER['HTTP_HOST'] . $theme_path . '/BookReader/images/';


        $data['script'] = array(
            'json' => json_encode($pages),
            'search_host' => json_encode($search_host),
            'imagesBaseURL' => json_encode($images_base_url),
            'query' => json_encode(q('q')),
        );
    }
    $euk_data = $data;
    return $euk_data;
}

function euk_zoom()
{
    global $euk_data;
    $euk_data = euk_page();
    $euk_data['action'] = 'zoom';
    return $euk_data;
}

function euk_text()
{
}

function euk_oai()
{
    header("Content-type: application/xml");
    require_once('oai.php');
    global $euk_data;
    global $oai_response;
    $euk_data['action'] = 'oai';
    $oai = euk_oai_response();
    return $euk_data;
}
