<?php

namespace ScheduledCommandBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ScheduledCommandBundleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $bundleConfig = $this->processConfiguration(new Configuration, $configs);

        $container->setParameter('scheduled.command.config', $bundleConfig);
        
        // load bundle's services
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }
}