<?php
/**
 * @file
 * Load bundle configuration and merge with main config file.
 */
namespace Itk\WayfBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;

/**
 * Class Configuration
 *
 * @package Itk\WayfBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface {
  /**
   * {@inheritDoc}
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('itk');

    // Try to load the self sign test certificate.
    $sslDirectories = array(__DIR__.'/Ressource/ssl');
    $locator = new FileLocator($sslDirectories);
    $certificate = $locator->locate('selfSigned.cert', null, TRUE);
    $key = $locator->locate('selfSigned.key', null, TRUE);

    $rootNode
      ->children()
        ->arrayNode('wayf')
          ->children()
            ->scalarNode('certificate')
              ->defaultValue($certificate)
            ->end()
            ->scalarNode('certificate_key')
              ->defaultValue($key)
            ->end()
          ->end()
        ->end()
      ->end();

    return $treeBuilder;
  }
}
