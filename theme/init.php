<?php
global $euk_base;
$euk_base = get_theme_option('euk_base');

function u($path) {
    global $euk_base;
    $url = str_replace('//', '/', "$euk_base$path");
    $url = preg_replace('/\?$/', '', $url);
    return $url;
}
