<?php

namespace ZfSnapUrl;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 *
 * @package ZfSnapUrl
 * @author  Witold Wasiczko <witold@wasiczko.pl>
 * @author  Grzegorz Rygielski <grzeogrz.rygielski@gmail.com>
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /**
     * Get config for autoloader
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Get module config
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
