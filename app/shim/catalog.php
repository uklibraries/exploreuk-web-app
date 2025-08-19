<?php
var_dump('env-test');
require_once('application/libraries/ExploreUK/init.php');
$app = new ExploreUK\ExploreUK();
$app->run();
