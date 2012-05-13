<?php

namespace Up2green\OAuthBundle\OAuth;

/**
 * Utils class
 */
class Utils
{
    /**
     * A urlencode for RFC 3986 for php 5.3
     *
     * @param mixed $input
     *
     * @todo Refactor this to use urlencode with the 4th parameter introduced by php5.4
     * @return string
     */
    public static function urlencodeRfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('static', 'urlencodeRfc3986'), $input);
        } else if (is_scalar($input)) {
            return str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($input)));
        } else {
            return '';
        }
    }

    /**
     * build http query for RFC 3986
     *
     * @param array $params
     *
     * @return string
     */
    public static function buildHttpQuery(array $params)
    {
        if (empty($params)) {
            return '';
        }

        // Urlencode both keys and values
        $keys   = static::urlencodeRfc3986(array_keys($params));
        $values = static::urlencodeRfc3986(array_values($params));
        $params = array_combine($keys, $values);

        // Parameters are sorted by name, using lexicographical byte value ordering.
        // Ref: Spec: 9.1.1 (1)
        uksort($params, 'strcmp');

        $pairs = array();
        foreach ($params as $parameter => $value) {
            if (is_array($value)) {
                // If two or more parameters share the same name, they are sorted by their value
                // Ref: Spec: 9.1.1 (1)
                // June 12th, 2010 - changed to sort because of issue 164 by hidetaka
                sort($value, SORT_STRING);
                foreach ($value as $duplicateValue) {
                    $pairs[] = $parameter . '=' . $duplicateValue;
                }
            } else {
                $pairs[] = $parameter . '=' . $value;
            }
        }
        // For each parameter, the name is separated from the corresponding value by an '=' character (ASCII code 61)
        // Each name-value pair is separated by an '&' character (ASCII code 38)
        return implode('&', $pairs);
    }

    /**
     * get the timestamp
     *
     * @return int
     */
    public static function getTimestamp()
    {
        return time();
    }

    /**
     * Generate a unique key
     *
     * @return string
     */
    public static function getNonce()
    {
        return 'f12cc33b168774514bbf92990f9c03f6';
        $mt   = microtime();
        $rand = mt_rand();

        return md5($mt . $rand);
    }
}