<?php

namespace Up2green\OAuthBundle\OAuth\Method;

use Buzz\Message\Request;
use Up2green\OAuthBundle\OAuth\Consumer;
use Up2green\OAuthBundle\OAuth\Utils as OAuthUtils;

/**
 * HmacSha1 Method Class
 */
class HmacSha1 implements MethodInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return "HMAC-SHA1";
    }

    /**
     * @param Request  $request
     * @param Consumer $consumer
     * @param type     $token
     *
     * @return type
     */
    public function buildSignature(Request $request, Consumer $consumer, $token = null)
    {
        $base = $request->getSignatureBaseString();

        $parts = array(
            $consumer->secret,
            ($token)
                    ? $token->secret
                    : ""
        );
        $parts = OAuthUtils::urlencodeRfc3986($parts);
        $key   = implode('&', $parts);

        return base64_encode(hash_hmac('sha1', $base, $key, true));
    }
}