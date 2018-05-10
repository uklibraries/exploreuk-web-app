<?php
# XXX: For portability, this should read from theme config
# if possible.  That's a little iffy.
global $euk_solr;
$euk_solr = 'https://exploreuk.uky.edu/solr/select/';

# XXX: Don't know a way not to hardcode this.
function euk_findingaid_redirect($id) {
    return "https://nyx.uky.edu/fa/findingaid/?id=$id";
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
    if (isset($result['response']) and $result['response']['docs'] > 0) {
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
    if (isset($result['response']) and $result['response']['docs'] > 0) {
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
$base = 'eukr';

if (preg_match("#^/$base/catalog/(?<id>[^/]+)/download/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    euk_download($id);
    exit;
}
elseif (preg_match("#^/$base/catalog/(?<id>[^/]+)/paged/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $dest = "https://$host/$base/index.php?action=paged&id=$id";
}
elseif (preg_match("#^/$base/catalog/(?<id>[^/]+)/text/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    euk_text($id);
    exit;
}
elseif (preg_match("#^/$base/catalog/(?<id>[^/]+)/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $format = euk_get_format($id);
    if ($format === 'collections') {
        header('Location: ' . euk_findingaid_redirect($id));
    }
    else {
        $dest = "https://$host/$base/index.php?action=page&id=$id";
    }
}
elseif (preg_match("#^/$base/catalog/?#", $request_uri, $matches)) {
    $dest = "https://$host/$base/index.php?action=index";
}
elseif (preg_match("#^/$base/text/(?<id>[^/]+)/?#", $request_uri, $matches)) {
    $id = $matches["id"];
    $dest = "https://$host/$base/index.php?action=text&id=$id";
}
else {
    $dest = "https://$host/$base/index.php?action=index";
}

if (strlen($query_string) > 0) {
    $dest .= "&$query_string";
}

# XXX: This section shouldn't be used in production (users won't
# be required to give passwords).  Instead, use the TODO section.
$username = 'okapi';
$home = $_SERVER['HOME']; # XXX: make this more robust
$password = trim(file_get_contents("$home/okapi/okapi.txt"));
$context = stream_context_create(array(
    'http' => array(
        'header' => 'Authorization: Basic ' . base64_encode("$username:$password")
    )
));
print file_get_contents($dest, false, $context);
# TODO: Uncomment this bit.  Comment out the above stanza.
/*
print file_get_contents($dest);
*/
