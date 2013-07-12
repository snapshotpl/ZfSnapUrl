<?php

namespace ZfSnapUrl\Tests;

use ZfSnapUrl\View\Helper\U;

/**
 * Class UTest
 *
 * @package ZfSnapUrl\Tests
 * @author  Grzegorz Rygielski <rygielski@red-sky.pl>
 */
class UTest extends \PHPUnit_Framework_TestCase
{
    public function testViewNotInited()
    {
        $routable = $this->getMock('ZfSnapUrl\Routable');

        $this->setExpectedException('Zend\View\Exception\RuntimeException', 'View not initialized');

        $u = new U();
        $u($routable);
    }

    public function testU()
    {
        $routeName = 'user/profile';
        $routeParams = array('id' => 1, 'slug' => 'someSlug');
        $routable = $this->getMock('ZfSnapUrl\Routable', array('getRouteName', 'getRouteParams'));
        $routable->expects($this->once())
            ->method('getRouteName')
            ->withAnyParameters()
            ->will($this->returnValue($routeName));
        $routable->expects($this->once())
            ->method('getRouteParams')
            ->withAnyParameters()
            ->will($this->returnValue($routeParams));

        $urlString = 'user/profile/1/someSlug';
        $urlMethod = 'ZfSnapUrl\Tests\ViewStub::url';
        $view = new ViewStub();
        $view->return[$urlMethod] = $urlString;

        $u = new U();
        $u->setView($view);
        $url = $u($routable);

        $this->assertEquals(array($routeName, $routeParams), $view->called[$urlMethod]);
        $this->assertInternalType('string', $url);
        $this->assertEquals($urlString, $url);
        unset($view->called[$urlMethod]);
        $this->assertEmpty($view->called);
    }
}
