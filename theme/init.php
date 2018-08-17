<?php
global $euk_base;
global $theme_path;
$euk_base = '';
if (realpath(BASE_DIR) !== realpath($_SERVER['DOCUMENT_ROOT'])) {
    $euk_base = basename(BASE_DIR);
}

function u($path)
{
    global $euk_base;
    $url = str_replace('//', '/', "$euk_base$path");
    $url = preg_replace('/\?$/', '', $url);
    if (strpos($url, '/') !== 0) {
        $url = "/$url";
    }
    return $url;
}
