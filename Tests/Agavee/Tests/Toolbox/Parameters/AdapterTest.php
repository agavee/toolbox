<?php

namespace Agavee\Tests\Toolbox\Parameters;

use Agavee\Toolbox\Parameters\Adapter as ParametersAdapter;
use Doctrine\Common\Collections\ArrayCollection;

class AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testNullValue()
    {
        $this->assertEquals(new ArrayCollection(), ParametersAdapter::valueToArrayCollection(null));
    }

    public function testValue()
    {
        $foo = new ArrayCollection(array('foo'));
        $five = new ArrayCollection(array(5));

        $this->assertEquals($foo, ParametersAdapter::valueToArrayCollection('foo'));
        $this->assertEquals($five, ParametersAdapter::valueToArrayCollection(5));
    }

    public function testArrayValue()
    {
        $foo = new ArrayCollection(array('foo'));
        $five = new ArrayCollection(array(5));

        $this->assertEquals($foo, ParametersAdapter::valueToArrayCollection(array('foo')));
        $this->assertEquals($five, ParametersAdapter::valueToArrayCollection(array(5)));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Expecting array or ArrayCollection
     */
    public function testObjectValue()
    {
        $object = (object)array('foo' => 'bar', 'bar' => 'baz');

        ParametersAdapter::valueToArrayCollection($object);
    }

    public function testArrayCollectionValue()
    {
        $foo = new ArrayCollection(array('foo'));

        $this->assertEquals($foo, ParametersAdapter::valueToArrayCollection($foo));
    }
}