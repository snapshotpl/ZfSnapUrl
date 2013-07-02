<?php

namespace ZfSnapUrl\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZfSnapUrl\Routable;

class U extends AbstractHelper
{
    public function __invoke(Routable $routableItem)
    {
        $view = $this->getView();
        $routeName = $routableItem->getRouteName();
        $routeParams = $routableItem->getRouteParams();

        return $view->url($routeName, $routeParams);
    }
}