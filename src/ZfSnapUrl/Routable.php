<?php

namespace ZfSnapUrl;

/**
 * @author witold
 */
interface Routable
{
    /**
     * return string
     */
    public function getRouteName();

    /**
     * return array
     */
    public function getRouteParams();
}