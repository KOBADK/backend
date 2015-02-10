<?php
/**
 * @file
 * Load bundle configuration and merge with main config file.
 */
namespace Koba\MainBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;

/**
 * Class Configuration
 *
 * @package Koba\AdminBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface {
  /**
   * {@inheritDoc}
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('koba_main');

    $rootNode
      ->children()
      ->end();

    return $treeBuilder;
  }
}
