<?php

namespace Agavee\Tests\Toolbox\Util;

use Agavee\Toolbox\Util\ArrayKeyHelper as Akh;

class KeyHelperTest extends \PHPUnit_Framework_TestCase
{
    private $default;
    private $flatArray;
    private $recursiveArray;

    public function __construct()
    {
        $this->default = 'fooBarBaz';
        $this->flatArray = array('foo' => 'bar');
        $this->recursiveArray = array('foo' => array('bar' => 'baz'));
    }

    public function testAkhGetHit()
    {
        $this->assertEquals('bar', Akh::get($this->flatArray, 'foo'));
    }

    public function testAkhGetMiss()
    {
        $this->assertEquals($this->default, Akh::get($this->flatArray, 'bar', $this->default));
    }

    public function testAkhGetRecursiveHit()
    {
        $this->assertEquals('baz', Akh::getRecursive($this->recursiveArray, array('foo', 'bar')));
    }

    public function testAkhGetRecursiveMiss()
    {
        $this->assertEquals($this->default, Akh::getRecursive($this->recursiveArray, array('bar', 'baz'), $this->default));
        $this->assertEquals($this->default, Akh::getRecursive($this->recursiveArray, array('foo','bar','baz'), $this->default));
    }

    public function testAkhSet()
    {
        $array = array();

        Akh::set($array, 'foo', 'bar');

        $this->assertEquals('bar', $array['foo']);
    }

    public function testAkhSetRecursiveWithEmptyArray()
    {
        $array = array();

        Akh::setRecursive($array, array('foo', 'bar'), 'baz');

        $this->assertEquals('baz', $array['foo']['bar']);
    }

    public function testAkhSetRecursiveWithArrayWithSetKeys()
    {
        $array = array('foo' => array('bar' => 123));

        Akh::setRecursive($array, array('foo', 'bar'), 'baz');

        $this->assertEquals('baz', $array['foo']['bar']);
    }
}