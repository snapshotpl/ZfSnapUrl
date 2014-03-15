<?php

namespace ZfSnapUrl\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;
use ZfSnapUrl\Routable;

/**
 * View helper
 *
 * @package ZfSnapUrl\View\Helper
 * @author  Witold Wasiczko <witold@wasiczko.pl>
 */
class U extends AbstractHelper
{
    /**
     * Make route
     *
     * @param Routable $routable routable item
     * @param string $routeName
     *
     * @return string Url                         For the link href attribute
     *
     * @throws Exception\RuntimeException         If View not initialized'
     * @throws Exception\RuntimeException         If no RouteStackInterface was provided
     * @throws Exception\RuntimeException         If no RouteMatch was provided
     * @throws Exception\RuntimeException         If RouteMatch didn't contain a matched route name
     * @throws Exception\InvalidArgumentException If the params object was not an array or \Traversable object
     */
    public function __invoke(Routable $routable, $routeName = null)
    {
        $view = $this->getView();

        if (empty($view)) {
            throw new Exception\RuntimeException('View not initialized');
        }

        if ($routeName === null) {
            $routeName = $routable->getRouteName();
        }
        $routeParams = $routable->getRouteParams();

        if (isset($routeParams[$routeName])) {
            $multiRoute = false;

            if (is_array($routeParams[$routeName])) {
                $multiRoute = $routeParams[$routeName];
            } else if (is_callable($routeParams[$routeName])) {
                $multiRoute = $routeParams[$routeName]();
            }

            if ($multiRoute !== false) {
                $routeName = $multiRoute['route'];
                $routeParams = $multiRoute['params'];
            }
        }
        return $view->url($routeName, $routeParams);
    }
}