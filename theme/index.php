<?php
require_once("init.php");
global $theme_path;
$theme_name = Theme::getCurrentThemeName('public');
$theme_path = u("/themes/$theme_name");
global $findaidurl;
global $featured_image;
global $popular_resources;
global $additional_resources;

require_once('euk/euk.php');

if (m('action') === 'oai') {
    require_once('templates/oai.php');
    exit;
}

if (euk_on_front_page()) {
    echo head();
    require_once('templates/front-page.php');
    echo foot();
    exit;
}

if (m('action') === 'paged') {
    euk_paged();
    require_once('templates/action-paged.php');
    exit;
}

if (m('action') === 'zoom') {
    require_once('templates/action-zoom.php');
    exit;
}

echo head();

switch (m('action')) {
case 'index':
    require_once('templates/action-index.php');
    break;
case 'page':
    require_once('templates/action-page.php');
    break;
default:
    print "<!-- " . euk_action() . " -->\n";
    print "<!-- \n";
    print json_encode($euk_data) . "\n";
    print " -->\n";
    break;
}

echo foot();
