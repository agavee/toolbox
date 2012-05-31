<?php

namespace Agavee\Bundle\ToolboxBundle\Tests\Model;

use Agavee\Bundle\ToolboxBundle\Model\Serializer;
use Agavee\Bundle\ToolboxBundle\Tests\Models\Person;

class SerializerTest extends \PHPUnit_Framework_TestCase
{
    private $foo;
    private $bar;
    private $baz;

    public function setUp()
    {
        $this->foo = new Person();
        $this->bar = new Person();
        $this->baz = new Person();

        $this->foo
            ->setName('foo')
            ->setSurname('oof')
            ->setSpouse($this->bar)
            ->addFriend($this->baz)
        ;

        $this->bar
            ->setName('bar')
            ->setSurname('rab')
            ->addFriend($this->baz)
        ;

        $this->baz
            ->setName('baz')
            ->setSurname('zab')
        ;
    }

    public function testSerializePlainObject()
    {
        $serializedBaz = array(
            'id' => null,
            'name' => 'baz',
            'surname' => 'zab',
            'spouse' => null,
            'friends' => array(),
        );

        $this->assertEquals(array(
            'id' => null,
            'name' => 'foo',
            'surname' => 'oof',
            'spouse' => array(
                'id' => null,
                'name' => 'bar',
                'surname' => 'rab',
                'spouse' => null,
                'friends' => array(
                    $serializedBaz,
                )
            ),
            'friends' => array(
                $serializedBaz,
            )
        ), $this->foo->toArray());
    }
}