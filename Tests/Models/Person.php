<?php

namespace Agavee\Bundle\ToolboxBundle\Tests\Models;

use Agavee\Bundle\ToolboxBundle\Model\Serializer;
use Agavee\Bundle\ToolboxBundle\Model\SerializableInterface;

/**
 * Description of Person
 */
class Person implements SerializableInterface
{
    private $id;
    private $name;
    private $surname;
    private $spouse;
    private $friends;

    public function __construct() {
        $this->friends = new \Doctrine\Common\Collections\ArrayCollection;
    }

    public function getId() {
        return  $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
        return $this;
    }

    public function getSpouse() {
        return $this->spouse;
    }

    public function setSpouse(Person $spouse) {
        $this->spouse = $spouse;
        return $this;
    }

    public function getFriends() {
        return $this->friends;
    }

    public function setFriends($friends) {
        $this->friends = $friends;
        return $this;
    }

    public function addFriend(Person $friend) {
        $this->friends->add($friend);
        return $this;
    }

    public function toArray()
    {
        return Serializer::toArray($this);
    }
}

