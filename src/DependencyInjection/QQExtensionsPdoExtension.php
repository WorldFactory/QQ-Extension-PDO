<?php

namespace WorldFactory\QQ\Extensions\Pdo\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use WorldFactory\QQ\Extensions\Pdo\DependencyInjection\Configurations\PDOConfiguration;

class QQExtensionsPdoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadConfiguration($container);
        $this->buildConfiguration($configs, $container);
    }

    protected function loadConfiguration(ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );

        $loader->load('config.yaml');
        $loader->load('services.yaml');
    }

    protected function buildConfiguration(array $configs, ContainerBuilder $container)
    {
        $configuration = new PDOConfiguration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('qq.pdo', $config);
    }
}
