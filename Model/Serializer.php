<?php

namespace Agavee\Bundle\ToolboxBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Object Serializer
 *
 * @author Claudio Beatrice <claudio@agavee.com>
 */
class Serializer {
    /**
     * Recursive serializer for objects
     *
     * It does not support recursive reference, eg objA that refrences objB and viceversa
     *
     * @param object $object
     *
     * @return array the object serialized into an array
     */
    public static function toArray($object)
    {
        $documentReflection = new \ReflectionClass(get_class($object));
        $documentProperties = $documentReflection->getProperties(\ReflectionProperty::IS_PROTECTED|\ReflectionProperty::IS_PRIVATE);

        $results = array();
        foreach ($documentProperties as $prop) {
            $name  = $prop->getName();
            $method = 'get' . ucfirst($name);
            $value = $object->$method();

            if ($value instanceof ArrayCollection) {
                $nameResults = array();
                foreach ($value as $innerValue) {
                    if (is_object($innerValue) && method_exists($innerValue, 'toArray')) {
                        $nameResults[] = $innerValue->toArray();
                    }
                }
                $results[$name] = $nameResults;
            } elseif ((is_object($value) && method_exists($value, 'toArray'))) {
                $results[$name] = $value->toArray($value);
            } else {
                $results[$name] = $value;
            }
        }

        return $results;
    }
}