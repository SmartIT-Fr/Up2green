<?php

namespace Up2green\OauthBundle\OAuth;

/**
 * Consumer class
 */
class Consumer
{
    public $key;
    public $secret;

    /**
     * Constructor
     *
     * @param string $key
     * @param string $secret
     */
    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * Return the key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Return the key
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * String representation of the consumer
     *
     * @return string
     */
    public function __toString()
    {
        return "OAuthConsumer[key=$this->key,secret=$this->secret]";
    }
}