<?php

namespace Up2green\OAuthBundle\Buzz\Message;

use Buzz\Message\Request;
use Buzz\Message\Response;
use Buzz\Message\Factory;

use Up2green\OAuthBundle\OAuth\Consumer;
use Up2green\OAuthBundle\OAuth\Method\MethodInterface;
use Up2green\OAuthBundle\Buzz\Message\OAuthRequest;

/**
 * OAuth Message Factory class
 */
class OAuthFactory extends Factory
{
    protected $consumer;
    protected $method;
    protected $version;

    /**
     * Constructor
     *
     * @param Consumer        $consumer
     * @param MethodInterface $method
     * @param type            $version
     */
    public function __construct(Consumer $consumer, MethodInterface $method, $version = "1.0")
    {
        $this->consumer = $consumer;
        $this->method   = $method;
        $this->version  = $version;
    }

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
        $request = new OAuthRequest($method, $resource, $host, array(
            'oauth_version'          => $this->version,
            'oauth_timestamp'        => $this->getTime(),
            'oauth_consumer_key'     => $this->consumer->getKey(),
            'oauth_signature_method' => $this->method->getName(),
        ));

        $request->sign($this->method, $this->consumer);

        return $request;
    }

    /**
     * Generate the timestamp of the requested authentificatin server
     *
     * @return int
     */
    public function getTime()
    {
        $datetime = new \DateTime('now + 10 MINUTES', new \DateTimeZone('America/New_York'));

        return $datetime->getTimestamp();
    }
}
