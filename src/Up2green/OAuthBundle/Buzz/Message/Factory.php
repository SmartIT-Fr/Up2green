<?php

namespace Up2green\OAuthBundle\Buzz\Message;

use Buzz\Message\Request;
use Buzz\Message\Factory as BaseFactory;

use Up2green\OAuthBundle\Buzz\Message\Request as OAuthRequest;

/**
 * OAuth Message Factory class
 */
class Factory extends BaseFactory
{
    /**
     * Create the Request
     *
     * @param string $method
     * @param string $resource
     * @param string $host
     *
     * @return \Buzz\Message\Request
     */
    public function createRequest($method = Request::METHOD_GET, $resource = '/', $host = null)
    {
        return new OAuthRequest($method, $resource, $host);
    }
}
