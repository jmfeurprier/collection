<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\CodeQuality\Rector\Class_\PreferPHPUnitThisCallRector;

$rootPath = realpath(__DIR__ . '/..') . '/';

return RectorConfig::configure()
    ->withCache($rootPath . 'var/cache/rector')
    ->withPaths(
        [
            $rootPath . 'src',
            $rootPath . 'tests',
        ],
    )
    ->withPhpSets()
    ->withSkip(
        [
            PreferPHPUnitThisCallRector::class,
        ],
    )
    ->withPreparedSets(
        deadCode:                 true,
        codeQuality:              true,
        codingStyle:              true,
        typeDeclarations:         true,
        typeDeclarationDocblocks: true,
        privatization:            true,
        naming:                   true,
        instanceOf:               true,
        earlyReturn:              true,
        carbon:                   true,
        rectorPreset:             true,
        phpunitCodeQuality:       true,
        doctrineCodeQuality:      true,
        symfonyCodeQuality:       true,
        symfonyConfigs:           true,
    )
;
