<?php

namespace Up2green\OAuthBundle\Buzz\Message;

use Buzz\Message\Request;
use Up2green\OAuthBundle\OAuth\Exception as OAuthException,
    Up2green\OAuthBundle\OAuth\Consumer,
    Up2green\OAuthBundle\OAuth\Method\MethodInterface,
    Up2green\OAuthBundle\OAuth\Utils as OAuthUtils;

class OAuthRequest extends Request
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * Constructor.
     *
     * @param string $method
     * @param string $resource
     * @param string $host
     */
    public function __construct($method = self::METHOD_GET, $resource = '/', $host = null, $parameters = array())
    {
        $this->method = strtoupper($method);
        $this->resource = $resource;
        $this->host = $host;
        $this->parameters = array_merge(array(
            'oauth_nonce'     => OAuthUtils::getNonce(),
            'oauth_timestamp' => OAuthUtils::getTimestamp(),
            ), $parameters);
    }

    /**
     * The request parameters, sorted and concatenated into a normalized string.
     *
     * @return string
     */
    public function getSignableParameters()
    {
        // Grab all parameters
        $params = $this->parameters;

        // Remove oauth_signature if present
        // Ref: Spec: 9.1.1 ("The oauth_signature parameter MUST be excluded.")
        if (isset($params['oauth_signature'])) {
            unset($params['oauth_signature']);
        }

        return $params;
    }

    /**
     * Returns the base string of this request
     *
     * The base string defined as the method, the url
     * and the parameters (normalized), each urlencoded
     * and the concated with &.
     */
    public function getSignatureBaseString()
    {
        $parts = array(
            $this->getMethod(),
            $this->getUrl(),
            OAuthUtils::buildHttpQuery($this->getSignableParameters())
        );

        $parts = OAuthUtils::urlencodeRfc3986($parts);

        return implode('&', $parts);
    }

    /**
     * Sign the Request with a signature method
     *
     * @param MethodInterface $method
     * @param Consumer $consumer
     */
    public function sign(MethodInterface $method, Consumer $consumer)
    {
        $this->setHeaders(array($this->buildOAuthHeader($this->getSignableParameters())));

        $this->parameters['oauth_signature'] = $method->buildSignature($this, $consumer);

        $this->setHeaders(array($this->buildOAuthHeader($this->parameters)));
    }

    /**
     * builds the Authorization: header
     */
    public function buildOAuthHeader(array $parameters)
    {
        $out = 'Authorization: OAuth ';

        foreach ($parameters as $k => $v) {
            if (substr($k, 0, 5) != "oauth") {
                continue;
            }

            if (is_array($v)) {
                throw new OAuthException('Arrays not supported in headers');
            }

            $out .= ',';
            $out .= OAuthUtils::urlencodeRfc3986($k);
            $out .= '="';
            $out .= OAuthUtils::urlencodeRfc3986($v);
            $out .= '"';
        }

        return $out;
    }

    /**
     * to string
     *
     * @return string
     */
    public function __toString()
    {
        $post_data = OAuthUtils::build_http_query($this->parameters);

        return $post_data
                ? $this->getUrl() . '?' . $post_data
                : $this->getUrl()
        ;
    }
}
