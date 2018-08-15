<?php
# We need to construct and initialize the Omeka application
# to read theme configuration variables (for example, where
# is Solr?).  Otherwise, we'd have to hardcode those variables
# here.

require_once 'bootstrap.php';
require_once 'globals.php';

$application = new Omeka_Application(APPLICATION_ENV);
$application->getBootstrap()->setOptions(array(
    'resources' => array(
        'theme' => array(
            'basePath' => THEME_DIR,
            'webBasePath' => WEB_RELATIVE_THEME,
        )
    )
));
$application->initialize();

global $euk_solr;
$euk_solr = get_theme_option('euk_solr');

global $euk_base;
$euk_base = '';
if (realpath(BASE_DIR) !== realpath($_SERVER['DOCUMENT_ROOT'])) {
    $euk_base = basename(BASE_DIR) . '/';
}

global $euk_findingaid_base_url;
$euk_findingaid_base_url = get_theme_option('euk_findingaid_base_url');

function euk_findingaid_redirect($id) {
    global $euk_findingaid_base_url;
    return "$euk_findingaid_base_url$id";
}

function euk_initialize_id() {
    global $euk_id;
    if (isset($_GET['id'])) {
        $euk_id = $_GET['id'];
    }
    else {
        $euk_id = 'unknown';
    }
}

function euk_initialize_query() {
    global $euk_query;
    $euk_query = array(
        'q' => null,
        'fq' => array(),
        'f' => array(),
        'offset' => 0,
        'rows' => 20,
    );
    $raw_params = array();
    if (isset($_SERVER['QUERY_STRING'])) {
        $raw_params = explode('&', str_replace('?', '', $_SERVER['QUERY_STRING']));
    }
    foreach ($raw_params as $raw_param) {
        preg_match('/(?<key>[^=]+)=(?<value>.*)/', $raw_param, $matches);
        if (count($matches) > 0) {
            $key = urldecode($matches['key']);
            $value = urldecode($matches['value']);
            if ($key == 'q' and strlen($value) > 0) {
                $euk_query['q'] = $value;
            }
            elseif ($key == 'fq[]') {
                $euk_query['fq'][] = $value;
            }
            elseif (substr($key, 0, 2) == 'f[') {
                $subkey = substr($key, 2, -3);
                $euk_query['f'][$subkey] = $value;
            }
            elseif ($key == 'offset') {
                $euk_query['offset'] = intval($value);
            }
        }
    }
    return $euk_query;
}

function euk_text($id) {
    global $euk_id;
    $euk_id = $id;
    global $euk_query;
    euk_initialize_query();
    $doc = euk_get_document($id);
    $text_field = 'text_s';

    if (array_key_exists($text_field, $doc)) {
        print '<pre>' . implode("\n", $doc[$text_field]) . "</pre>\n";
    }
}

function euk_oai() {
    global $euk_oai_options;
    require_once('oai.php');
    $response = euk_oai_response();
    $doc = new DOMDocument('1.0', 'utf-8');
    $root = $doc->createElementNS('http://www.openarchives.org/OAI/2.0/', 'OAI-PMH');
    $root = $doc->appendChild($root);
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
    $root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd');

    $responseDate = $doc->createElement('responseDate', $response['responseDate']);
    $responseDate = $root->appendChild($responseDate);

    $request = $doc->createElement('request', $response['request']);
    if (isset($response['verb'])) {
        $request->setAttribute('verb', $response['verb']);
    }
    foreach ($euk_oai_options as $option) {
        if (isset($response[$option])) {
            $request->setAttribute($option, $response[$option]);
        }
    }
    $request = $root->appendChild($request);

    if (isset($response['error'])) {
        $error = $doc->createElement('error', $response['error']['message']);
        $error->setAttribute('code', $response['error']['code']);
        $error = $root->appendChild($error);
        if (isset($response['extra'])) {
            $extra = $doc->createElement('extra', $response['extra']);
            $extra = $root->appendChild($extra);
        }
    }
    else {
        $node = $doc->createElement($response['verb'], '');
        $node = $root->appendChild($node);
        if ($response['verb'] === 'Identify') {
            foreach ($response['metadata'] as $spec) {
                $field = $spec[0];
                $content = $spec[1];
                if ($field === 'description') {
                    $child = $doc->createElement($field, '');
                    $child = $node->appendChild($child);
                    $oai_id = $doc->createElementNS('http://www.openarchives.org/OAI/2.0/oai-identifier', 'oai-identifier');
                    $oai_id = $child->appendChild($oai_id);
                    $oai_id->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
                    $oai_id->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.openarchives.org/OAI/2.0/oai-identifier http://www.openarchives.org/OAI/2.0/oai-identifier.xsd');
                    foreach ($content as $item) {
                        $subchild = $doc->createElement($item[0], $item[1]);
                        $subchild = $oai_id->appendChild($subchild);
                    }
                    continue;
                }
                if (!is_array($content)) {
                    $content = array($content);
                }
                foreach ($content as $item) {
                    $child = $doc->createElement($field, $item);
                    $child = $node->appendChild($child);
                }
            }
        }
        # XXX: seek opportunities to merge code?
        elseif ($response['verb'] === 'ListMetadataFormats') {
            foreach ($response['metadata']['results'] as $result_rows) {
                $result_node = $doc->createElement('metadataFormat', '');
                $result_node = $node->appendChild($result_node);
                foreach ($result_rows as $row) {
                    $child = $doc->createElement($row[0], $row[1]);
                    $child = $result_node->appendChild($child);
                }
            }
        }
        elseif ($response['verb'] === 'ListSets') {
            foreach ($response['metadata']['results'] as $result_rows) {
                $result_node = $doc->createElement('set', '');
                $result_node = $node->appendChild($result_node);
                foreach ($result_rows as $row) {
                    $child = $doc->createElement($row[0], $row[1]);
                    $child = $result_node->appendChild($child);
                }
            }
        }
        elseif ($response['verb'] === 'GetRecord') {
            foreach ($response['metadata']['results'] as $record) {
                $result_node = $doc->createElement('record', '');
                $result_node = $node->appendChild($result_node);
                # header
                $header = $doc->createElement('header', '');
                $header = $result_node->appendChild($header);
                foreach ($record['header'] as $row) {
                    $child = $doc->createElement($row[0], $row[1]);
                    $child = $header->appendChild($child);
                }

                # metadata
                $metadata = $doc->createElement('metadata', '');
                $metadata = $result_node->appendChild($metadata);

                $oai_dc = $doc->createElementNS('http://www.openarchives.org/OAI/2.0/oai_dc/', 'oai_dc:dc');
                $oai_dc = $metadata->appendChild($oai_dc);
                $oai_dc->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:dc', 'http://purl.org/dc/elements/1.1/');
                $oai_dc->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
                $oai_dc->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd');

                foreach ($record['metadata'] as $row) {
                    $child = $doc->createElement('dc:' . $row[0], $row[1]);
                    $child = $oai_dc->appendChild($child);
                }
            }
        }
        elseif ($response['verb'] === 'ListIdentifiers') {
            foreach ($response['metadata']['results'] as $record) {
                # header
                $header = $doc->createElement('header', '');
                $header = $node->appendChild($header);
                foreach ($record['header'] as $row) {
                    $child = $doc->createElement($row[0], $row[1]);
                    $child = $header->appendChild($child);
                }
            }
            $token = $doc->createElement('resumptionToken', $response['metadata']['resumptionToken']);
            $token = $node->appendChild($token);
        }
        elseif ($response['verb'] === 'ListRecords') {
            foreach ($response['metadata']['results'] as $record) {
                $result_node = $doc->createElement('record', '');
                $result_node = $node->appendChild($result_node);
                # header
                $header = $doc->createElement('header', '');
                $header = $result_node->appendChild($header);
                foreach ($record['header'] as $row) {
                    $child = $doc->createElement($row[0], $row[1]);
                    $child = $header->appendChild($child);
                }

                # metadata
                $metadata = $doc->createElement('metadata', '');
                $metadata = $result_node->appendChild($metadata);

                $oai_dc = $doc->createElementNS('http://www.openarchives.org/OAI/2.0/oai_dc/', 'oai_dc:dc');
                $oai_dc = $metadata->appendChild($oai_dc);
                $oai_dc->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:dc', 'http://purl.org/dc/elements/1.1/');
                $oai_dc->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
                $oai_dc->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd');

                foreach ($record['metadata'] as $row) {
                    $child = $doc->createElement('dc:' . $row[0], $row[1]);
                    $child = $oai_dc->appendChild($child);
                }
            }
            $token = $doc->createElement('resumptionToken', $response['metadata']['resumptionToken']);
            $token = $node->appendChild($token);
        }
    }

    header('Content-type: application/xml');
    print $doc->saveXML();
}

function euk_find($id) {
    global $euk_solr;

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
    print json_encode($response); # . "\n";
}

function euk_highlight_snippet($text, $raw_terms, $radius) {
    $terms = preg_split('/\s+/', $raw_terms, NULL, PREG_SPLIT_NO_EMPTY);
    $words = explode(' ', preg_replace('/\s+/', ' ', $text));
    $wanted = array_fill(0, count($words), 0);
    for ($i = 0; $i < count($words); $i++) {
        foreach ($terms as $term) {
            if (preg_match("/\b$term\b/i", $words[$i])) {
                $words[$i] = '{{{' . $words[$i] . '}}}';
                $low = $i - $radius;
                if ($low < 0) {
                    $low = 0;
                }
                $high = $i + $radius;
                if ($high >= count($words)) {
                    $high = count($words) - 1;
                }
                $len = $high - $low + 1;
                array_splice($wanted, $low, $len, array_fill(0, $len, 1));
            }
        }
    }
    $result = array();
    $current = false;
    for ($i = 0; $i < count($wanted); $i++) {
        if ($wanted[$i]) {
            $result[] = $words[$i];
            $current = false;
        }
        else if (!$current) {
            $current = true;
            $result[] = '…';
        }
    }
    return implode(' ', $result);
}

function euk_download($id) {
    global $euk_id;
    $euk_id = $id;
    global $euk_query;
    euk_initialize_query();

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

function euk_get_document($id) {
    global $euk_solr;
    $url = "$euk_solr?" . euk_document_query($id);
    $result = json_decode(file_get_contents($url), true);
    if (isset($result['response']) and count($result['response']['docs']) > 0) {
        return $result['response']['docs'][0];
    }
    else {
        return null;
    }
}

function euk_document_query($id) {
    $pieces = array();
    $pieces[] = 'fq=' . urlencode("id:$id");
    $pieces[] = 'fl=' . urlencode("*");
    $pieces[] = 'wt=json';
    return implode('&', $pieces);
}

function euk_get_format($id) {
    global $euk_solr;
    $url = "$euk_solr?" . euk_format_query($id);
    $result = json_decode(file_get_contents($url), true);
    if (isset($result['response']) and count($result['response']['docs']) > 0) {
        return $result['response']['docs'][0]['format'];
    }
    else {
        return null;
    }
}

function euk_format_query($id) {
    $pieces = array();
    $pieces[] = 'fq=' . urlencode("id:$id");
    $pieces[] = 'fl=' . urlencode("format");
    $pieces[] = 'wt=json';
    return implode('&', $pieces);
}

if (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];
}
else {
    $host = $_SERVER['SERVER_NAME'];
}

$request_uri = strtok($_SERVER['REQUEST_URI'], '?');
$query_string = $_SERVER['QUERY_STRING'];

if (preg_match("#^/${euk_base}catalog/oai/?#", $request_uri, $matches)) {
    euk_oai();
    exit;
}
elseif (preg_match("#^/${euk_base}catalog/(?<id>[^/]+)/find/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    euk_find($id);
    exit;
}
elseif (preg_match("#^/${euk_base}catalog/(?<id>[^/]+)/download/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    euk_download($id);
    exit;
}
elseif (preg_match("#^/${euk_base}catalog/(?<id>[^/]+)/paged/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $dest = "https://$host/${euk_base}index.php?action=paged&id=$id";
}
elseif (preg_match("#^/${euk_base}catalog/(?<id>[^/]+)/text/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    euk_text($id);
    exit;
}
elseif (preg_match("#^/${euk_base}catalog/(?<id>[^/]+)/zoom/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $dest = "https://$host/${euk_base}index.php?action=zoom&id=$id";
}
elseif (preg_match("#^/${euk_base}catalog/(?<id>[^/]+)/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $format = euk_get_format($id);
    if ($format === 'collections') {
        header('Location: ' . euk_findingaid_redirect($id));
        exit;
    }
    else {
        $dest = "https://$host/${euk_base}index.php?action=page&id=$id";
    }
}
elseif (preg_match("#^/${euk_base}catalog/?#", $request_uri, $matches)) {
    $dest = "https://$host/${euk_base}index.php?action=index";
}
elseif (preg_match("#^/${euk_base}text/(?<id>[^/]+)/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $dest = "https://$host/${euk_base}index.php?action=text&id=$id";
}
else {
    $dest = "https://$host/${euk_base}index.php?action=index";
}

if (strlen($query_string) > 0) {
    $dest .= "&$query_string";
}

# XXX: Verify that this is not needed.
# Clean up destination.
$dest = str_replace("$host//", "$host/", $dest);
print file_get_contents($dest);
