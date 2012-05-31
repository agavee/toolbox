<?php

namespace Agavee\Bundle\ToolboxBundle\Parameters;

/**
 * Parameters Checker
 *
 * @author Claudio Beatrice <claudio@agavee.com>
 */
class Checker
{
    /**
     * Checks that an array of options contains all the mandatory keys
     *
     * @param array $parameters the array with the actual parameters
     * @param array $mandatoryParams the array with the mandatory parameters
     * @param string $message optional error message
     *
     * @throws UnexpectedValueException if one or more mandatory parameters are not present in $parameters
     *
     * @return true
     */
    public static function check(array $parameters, array $mandatoryParams = array(), $message = 'Parameter missing: %s')
    {
        $parametersKeys = array_keys($parameters);
        foreach ($mandatoryParams as $mandatoryParam) {
            if (!in_array($mandatoryParam, $parametersKeys)) {
                throw new \UnexpectedValueException(sprintf($message, $mandatoryParam));
            }
        }
        return true;
    }
}