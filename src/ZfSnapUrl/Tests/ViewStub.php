<?php

namespace ZfSnapUrl\Tests;

use Zend\View\Model\ModelInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;

/**
 * Class ViewStub - stub ResolverInterface
 *
 * @package ZfSnapUrl\View\Helper
 * @author  Grzegorz Rygielski <rygielski@red-sky.pl>
 */
class ViewStub implements RendererInterface
{
    public $called = array();
    public $return = array();

    public function url()
    {
        $this->called[__METHOD__] = func_get_args();
        return $this->return[__METHOD__];
    }

    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        $this->called[__METHOD__] = func_get_args();
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @param  ResolverInterface $resolver
     * @return RendererInterface
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->called[__METHOD__] = func_get_args();
    }

    /**
     * Processes a view script and returns the output.
     *
     * @param  string|ModelInterface $nameOrModel The script/resource process, or a view model
     * @param  null|array|\ArrayAccess $values      Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        $this->called[__METHOD__] = func_get_args();
    }
}
