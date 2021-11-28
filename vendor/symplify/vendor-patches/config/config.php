<?php

declare (strict_types=1);
namespace RectorPrefix20211128;

use RectorPrefix20211128\SebastianBergmann\Diff\Differ;
use RectorPrefix20211128\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
use RectorPrefix20211128\Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use RectorPrefix20211128\Symplify\PackageBuilder\Composer\VendorDirProvider;
use RectorPrefix20211128\Symplify\PackageBuilder\Console\Command\CommandNaming;
use RectorPrefix20211128\Symplify\PackageBuilder\Yaml\ParametersMerger;
use RectorPrefix20211128\Symplify\SmartFileSystem\Json\JsonFileSystem;
use RectorPrefix20211128\Symplify\VendorPatches\Console\VendorPatchesConsoleApplication;
use function RectorPrefix20211128\Symfony\Component\DependencyInjection\Loader\Configurator\service;
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('RectorPrefix20211128\Symplify\\VendorPatches\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/Kernel', __DIR__ . '/../src/ValueObject']);
    $services->set(\RectorPrefix20211128\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder::class)->args(['$addLineNumbers' => \true]);
    $services->set(\RectorPrefix20211128\SebastianBergmann\Diff\Differ::class)->args(['$outputBuilder' => \RectorPrefix20211128\Symfony\Component\DependencyInjection\Loader\Configurator\service(\RectorPrefix20211128\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder::class)]);
    $services->set(\RectorPrefix20211128\Symplify\PackageBuilder\Composer\VendorDirProvider::class);
    $services->set(\RectorPrefix20211128\Symplify\SmartFileSystem\Json\JsonFileSystem::class);
    $services->alias(\RectorPrefix20211128\Symfony\Component\Console\Application::class, \RectorPrefix20211128\Symplify\VendorPatches\Console\VendorPatchesConsoleApplication::class);
    $services->set(\RectorPrefix20211128\Symplify\PackageBuilder\Console\Command\CommandNaming::class);
    $services->set(\RectorPrefix20211128\Symplify\PackageBuilder\Yaml\ParametersMerger::class);
};