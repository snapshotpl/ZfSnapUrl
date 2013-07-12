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
 * @author  Grzegorz Rygielski <grzeogrz.rygielski@red-sky.pl>
 */
class U extends AbstractHelper
{
    /**
     * Make route
     *
     * @param Routable $routable routable item
     *
     * @return string Url                         For the link href attribute
     *
     * @throws Exception\RuntimeException         If View not initialized'
     * @throws Exception\RuntimeException         If no RouteStackInterface was provided
     * @throws Exception\RuntimeException         If no RouteMatch was provided
     * @throws Exception\RuntimeException         If RouteMatch didn't contain a matched route name
     * @throws Exception\InvalidArgumentException If the params object was not an array or \Traversable object
     */
    public function __invoke(Routable $routable)
    {
        $view = $this->getView();
        if (empty($view)) {
            throw new Exception\RuntimeException('View not initialized');
        }

        $routeName   = $routable->getRouteName();
        $routeParams = $routable->getRouteParams();

        return $view->url($routeName, $routeParams);
    }
}
