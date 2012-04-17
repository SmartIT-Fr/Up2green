<?php

namespace Up2green\OAuthBundle\OAuth\Method;

use Buzz\Message\Request;
use Up2green\OAuthBundle\OAuth\Consumer;

/**
 * Method interface
 */
interface MethodInterface
{

    /**
     * Needs to return the name of the Signature Method (ie HMAC-SHA1)
     *
     * @return string
     */
    public function getName();

    /**
     * Build up the signature
     * NOTE: The output of this function MUST NOT be urlencoded.
     * the encoding is handled in OAuthRequest when the final
     * request is serialized
     *
     * @param Request       $request
     * @param OAuthConsumer $consumer
     * @param OAuthToken    $token
     *
     * @return string
     */
    public function buildSignature(Request $request, Consumer $consumer, $token);
}
