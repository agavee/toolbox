<?php

namespace Agavee\Toolbox\Parameters;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Parameters Adapter
 *
 * @author Claudio Beatrice <claudio@agavee.com>
 */
class Adapter {
    /**
     * Adapt a value to fit into an array collection, if possible
     *
     * @param mixed $value
     *
     * @throws InvalidArgumentException
     *
     * @return ArrayCollection
     */
    public static function valueToArrayCollection($value = array())
    {
        if (empty($value)) {
            $value = array();
        }
        if (!is_array($value) && !is_object($value)) {
            $value = array($value);
        }
        if (is_array($value)) {
            $value = new ArrayCollection($value);
        }
        if (!$value instanceof ArrayCollection) {
            throw new \InvalidArgumentException('Expecting array or ArrayCollection');
        }
        return $value;
    }
}