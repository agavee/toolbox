<?php

namespace Agavee\Toolbox\Util;

/**
 * Array Key Helper
 *
 * This class contains four methods to help with array key access
 *
 * @author Claudio Beatrice <claudio@agavee.com>
 */
class ArrayKeyHelper
{
    /**
     * An array key getter
     *
     * Use this when you have one-level array,
     * ie: $arr = array('key1' => 'value1', 'key2' => 'value2');
     *
     * @param array  $array   array from which you want to get data
     * @param string $key     array key you want to extract
     * @param mixed  $default fallback value in case of non-existent key
     *
     * @return
     *   if the passed key of the array exists, return the corresponding value,
     *   else return the default value(if passed); as last resort return null.
     */
    public static function get(array $array, $key, $default = null) {
        return (isset($array[$key])) ? $array[$key] : $default;
    }

    /**
     * A recursive array key getter
     *
     * Use this when you have multiple-levels array,
     * ie: $arr = array('key1' => array('key3' => array('key4' => 'value4')),
     *                  'key2' => 'value2');
     *
     * @param array $array   array from which you want to get data
     * @param array $key     array containing index path of the key you want
     *                       to extract(ie: array('a', 'b', 'c')
     *                       will point to $array['a']['b']['c'])
     * @param mixed $default fallback value in case of non-existent key
     *
     * @return
     *   if the passed key of the array exists, return the corresponding value,
     *   else return the default value(if passed); as last resort return null.
     */
    public static function getRecursive(array $array, array $key, $default = null) {
        $innerKey = array_shift($key);

        if (!isset($array[$innerKey])) {
            return $default;
        }

        if (empty($key)) {
            return $array[$innerKey];
        }

        if (!is_array($array[$innerKey])) {
            return $default;
        }

        return static::getRecursive($array[$innerKey], $key, $default);
    }

    /**
     * An array key setter
     *
     * Use this when you have one-level array,
     * ie: $arr = array('key1' => 'value1', 'key2' => 'value2');
     *
     * @param array  $array array in which you want to set data
     * @param string $key   array key in which you want to store value
     * @param mixed  $value value you want to set
     *
     * @return
     *   if the key already exists, the old value of the array,
     *   else NULL
     */
    public static function set(array &$array, $key, $value = null) {
        $oldValue = static::get($array, $key);
        $array[$key] = $value;
        return $oldValue;
    }

    /**
     * A recursive array key setter
     *
     * Use this when you have multiple-levels array,
     * ie: $arr = array('key1' => array('key3' => array('key4' => 'value4')),
     *                  'key2' => 'value2');
     *
     * @param array &$array array in which you want to set data
     * @param array $key    array containing index path in which you want
     *                      to store value(ie: array('a', 'b', 'c')
     *                      will point to $array['a']['b']['c'])
     * @param mixed $value  value you want to set
     *
     * @return
     *   if the key already exists, the old value of the array,
     *   else NULL
     */
    public static function setRecursive(array &$array, array $key = array(), $value = null) {
        $oldValue = static::getRecursive($array, $key);
        if (($innerKey = array_shift($key))) {
            if (!isset($array[$innerKey])) {
                $array[$innerKey] = array();
            }
            if (!is_array($array[$innerKey])) {
                $array[$innerKey] = array($array[$innerKey]);
            }
            static::setRecursive($array[$innerKey], $key, $value);
        } else {
            $array = $value;
        }
        return $oldValue;
    }
}
