<?php
declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
	->withPaths([
	__DIR__ . '/app/shim',
])
# Ensures Rector runs with whatever PHP version it finds in composer.json
->withPhpSets()
->withComposerBased(phpunit: true)
->withTypeCoverageLevel(0)
->withDeadCodeLevel(0)
->withCodeQualityLevel(0);
