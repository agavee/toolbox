<?php

namespace Agavee\Bundle\ToolboxBundle\Tests\Parameters;

use Agavee\Bundle\ToolboxBundle\Parameters\Checker as ParametersChecker;

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage Parameter missing: foo
     */
    public function testCheckParamsWithoutParamsAndWithOneMandatoryParam()
    {
        ParametersChecker::check(array(), array('foo'));
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage Parameter missing: bar
     */
    public function testCheckParamsWithOneParamAndWithTwoMandatoryParams()
    {
        ParametersChecker::check(array('foo' => 'baz'), array('foo', 'bar'));
    }

    public function testCheckParamsWithTwoParamsAndWithoutMandatoryParams()
    {
        $this->assertTrue(ParametersChecker::check(array('foo' => 'baz'), array()));
    }
}