<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/shim',
    ])
    // uncomment to reach your current PHP version
    //->withPhpSets()
    ->withSets([
	LevelSetList::UP_TO_PHP_84,
    ])
    ->withTypeCoverageLevel(0)
    ->withDeadCodeLevel(0)
    ->withCodeQualityLevel(0);
