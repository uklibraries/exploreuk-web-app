<?php

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$app = new ExploreUK\ExploreUK(
    ExploreUK\Config::fromEnv(),
    EUK_BASE_DIR . '/assets',
);
$app->run();
