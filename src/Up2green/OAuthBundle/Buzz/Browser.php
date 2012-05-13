<?php

namespace Up2green\OAuthBundle\Buzz;

use Buzz\Browser as BaseBrowser;
use Buzz\Client\ClientInterface;
use Buzz\Message\FactoryInterface;

use Up2green\OAuthBundle\OAuth\Consumer;
use Up2green\OAuthBundle\OAuth\Method\MethodInterface;

/**
 * OAuth Browser class
 */
class Browser extends BaseBrowser
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
    public function __construct(ClientInterface $client = null, FactoryInterface $factory = null, Consumer $consumer, MethodInterface $method, $version = "1.0")
    {
        $this->consumer = $consumer;
        $this->method   = $method;
        $this->version  = $version;

        parent::__construct($client, $factory);
    }

    /**
     * Sends a request.
     *
     * @param string $url     The URL to call
     * @param string $method  The request method to use
     * @param array  $headers An array of request headers
     * @param string $content The request content
     *
     * @return Message\Response The response object
     */
    public function call($url, $method, $headers = array(), $content = '')
    {
        $request = $this->getMessageFactory()->createRequest($method);

        $headers = array_merge(array(
            'oauth_version'          => $this->version,
            'oauth_timestamp'        => $this->getTime(),
            'oauth_consumer_key'     => $this->consumer->getKey(),
            'oauth_signature_method' => $this->method->getName(),
        ), $headers);

        $headers['oauth_signature'] = $this->method->buildSignature($request, $this->consumer);

        $request->fromUrl($url);
        $request->addHeaders($headers);
        $request->setContent($content);

        return $this->send($request);
    }


}
