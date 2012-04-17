<?php

namespace Up2green\OAuthBundle\OAuth\Method;

use Buzz\Message\Request;
use Up2green\OAuthBundle\OAuth\Consumer;
use Up2green\OAuthBundle\OAuth\Utils as OAuthUtils;

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
     * @param Request $request
     * @param Consumer $consumer
     * @param type $token
     *
     * @return type 
     */
    public function buildSignature(Request $request, Consumer $consumer, $token = null)
    {
        $base = $request->getSignatureBaseString();

        $key_parts = array(
            $consumer->secret,
            ($token)
                    ? $token->secret
                    : ""
        );

        $key_parts = OAuthUtils::urlencodeRfc3986($key_parts);
        $key       = implode('&', $key_parts);

        return base64_encode(hash_hmac('sha1', $base, $key, true));
    }
}