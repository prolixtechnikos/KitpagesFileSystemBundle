<?php

namespace Kitpages\FileSystemBundle\DependencyInjection\Factory;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ChildDefinition;

class AmazonS3AdapterFactory implements AdapterFactoryInterface
{
    /**
    * Creates the adapter, registers it and returns its id
    *
    * @param  ContainerBuilder $container  A ContainerBuilder instance
    * @param  string           $id         The id of the service
    * @param  array            $config     An array of configuration
    */
    public function create(ContainerBuilder $container, $id, array $config)
    {

        $container
            ->setDefinition($id, new ChildDefinition('kitpages_file_system.adapter.amazon_s3'))
            ->addArgument(new Reference('kitpages.util'))
            ->addArgument(new Reference('event_dispatcher'))
            ->addArgument($config['bucket_name'])
            ->addArgument($config['key'])
            ->addArgument($config['secret_key'])
            ->addArgument($id)
            ->setPublic(true)
        ;
    }

    /**
     * Returns the key for the factory configuration
     *
     * @return string
     */
    public function getKey()
    {
        return 'amazon_s3';
    }

    /**
     * Adds configuration nodes for the factory
     *
     * @param  NodeBuilder $builder
     */
    public function addConfiguration(NodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('key')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('secret_key')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('bucket_name')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;
    }
}
