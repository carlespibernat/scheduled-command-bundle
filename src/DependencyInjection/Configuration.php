<?php

namespace ScheduledCommandBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root("scheduled_command");

        $rootNode
            ->children()
                ->scalarNode("temp_command_files_dir")
                    ->defaultValue("/tmp")
                    ->info("The directory where will be the commands that will be executed by the command scheduler")
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

}