<?php
require_once("init.php");
global $theme_path;
$theme_path = u('/themes/omeukaprologue');
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
