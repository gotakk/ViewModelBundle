<?php

namespace gotakk\ViewModelBundle\Tests\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class YamlAcmeDemoExtensionTest extends AbstractGotakkViewModelExtensionTest
{
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Fixtures/Yaml/'));
        $loader->load($resource . '.yml');
    }
}
