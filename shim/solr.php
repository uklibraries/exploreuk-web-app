<?php
# XXX: Verify that this file is still needed.

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
$url = "$euk_solr?" . $_SERVER['QUERY_STRING'];
print file_get_contents($url);
