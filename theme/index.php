<?php
require_once("init.php");
global $theme_path;
$theme_name = Theme::getCurrentThemeName('public');
$theme_path = u("/themes/$theme_name");
global $findaidurl;
global $featured_collections;
global $featured_image;

require_once('euk/euk.php');

if (m('action') === 'paged') {
    euk_paged();
    require_once('templates/action-paged.php');
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
