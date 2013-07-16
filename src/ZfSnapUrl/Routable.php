<?php

namespace ZfSnapUrl;

/**
 * Routable Interface required by ViewHelper\U
 *
 * @package ZfSnapUrl
 * @author  Witold Wasiczko <witold@wasiczko.pl>
 */
interface Routable
{
    /**
     * Get route name
     * @return string
     */
    public function getRouteName();

    /**
     * Get route params
     * @return array
     */
    public function getRouteParams();
}
