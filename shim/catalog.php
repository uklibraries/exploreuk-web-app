<?php
if (!defined('EUK_BASE_DIR')) {
    define('EUK_BASE_DIR', dirname(__FILE__));
}
require_once('application/libraries/ExploreUK/init.php');
$app = new ExploreUK\ExploreUK();
$app->run();
