<?php

namespace ScheduledCommandBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ScheduledCommandBundleExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $bundleConfig = $this->processConfiguration(new Configuration, $configs);

        $container->setParameter('scheduled.command.config', $bundleConfig);
    }
}