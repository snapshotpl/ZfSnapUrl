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
    private $routeName = 'user/profile';
    private $routeParams = array(
        'id' => 1,
        'slug' => 'someSlug',
    );
    private $finalUrlString = 'user/profile/1/someSlug';
    private $urlMethod = 'ZfSnapUrl\Tests\ViewStub::url';

    public function testViewNotInited()
    {
        $routable = $this->getMock('ZfSnapUrl\Routable');

        $this->setExpectedException('Zend\View\Exception\RuntimeException', 'View not initialized');

        $u = new U();
        $u($routable);
    }

    public function testU()
    {
        $routable = $this->getRoutableMock($this->routeName, $this->routeParams);
        $view = $this->getView();

        $u = new U();
        $u->setView($view);
        $url = $u($routable);

        $this->assertionsCorrectUse($view, $url);
    }

    public function testMultiRoutesDefault()
    {
        $routable = $this->getMultiRoutableMock();
        $view = $this->getView();

        $u = new U();
        $u->setView($view);
        $url = $u($routable);

        $this->assertionsCorrectUse($view, $url);
    }

    public function testMultiRoutesChoosed()
    {
        $routable = $this->getMultiRoutableMock();
        $view = $this->getView();

        $u = new U();
        $u->setView($view);
        $url = $u($routable, 'secondRoute');

        $this->assertionsCorrectUse($view, $url);
    }

    public function testCallableMultiRoutesDefault()
    {
        $routable = $this->getCallableMultiRoutableMock();
        $view = $this->getView();

        $u = new U();
        $u->setView($view);
        $url = $u($routable);

        $this->assertionsCorrectUse($view, $url);
    }

    public function testCallableMultiRoutesChoosed()
    {
        $routable = $this->getCallableMultiRoutableMock();
        $view = $this->getView();

        $u = new U();
        $u->setView($view);
        $url = $u($routable, 'secondRoute');

        $this->assertionsCorrectUse($view, $url);
    }

    private function assertionsCorrectUse(ViewStub $view, $result)
    {
        $this->assertEquals(array($this->routeName, $this->routeParams), $view->called[$this->urlMethod]);
        $this->assertInternalType('string', $result);
        $this->assertEquals($this->finalUrlString, $result);
        unset($view->called[$this->urlMethod]);
        $this->assertEmpty($view->called);
    }

    private function getView()
    {
        $view = new ViewStub();
        $view->return[$this->urlMethod] = $this->finalUrlString;

        return $view;
    }

    private function getRoutableMock($name, $params)
    {
        $routable = $this->getMock('ZfSnapUrl\Routable', array('getRouteName', 'getRouteParams'));
        $routable->expects($this->any())
                ->method('getRouteName')
                ->withAnyParameters()
                ->will($this->returnValue($name));
        $routable->expects($this->once())
                ->method('getRouteParams')
                ->withAnyParameters()
                ->will($this->returnValue($params));

        return $routable;
    }

    private function getMultiRoutableMock()
    {
        return $this->getRoutableMock('firstRoute', array(
                    'firstRoute' => array(
                        'route' => $this->routeName,
                        'params' => $this->routeParams,
                    ),
                    'secondRoute' => array(
                        'route' => $this->routeName,
                        'params' => $this->routeParams,
                    ),
        ));
    }

    private function getCallableMultiRoutableMock()
    {
        return $this->getRoutableMock('firstRoute', array(
                    'firstRoute' => function () {
                        return array(
                            'route' => $this->routeName,
                            'params' => $this->routeParams,
                        );
                    },
                    'secondRoute' => function () {
                        return array(
                            'route' => $this->routeName,
                            'params' => $this->routeParams,
                        );
                    },
        ));
    }
}
