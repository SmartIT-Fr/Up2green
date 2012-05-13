<?php

namespace Up2green\SearchBundle\Buzz\Browser;

use Up2green\OAuthBundle\Buzz\Browser as OAuthBrowser;

/**
 * Yahoo browser
 */
class YahooBrowser extends OAuthBrowser
{
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
        $headers = array_merge(array(
            'oauth_timestamp' => $this->getTime(),
        ), $headers);

        return parent::call($url, $method, $headers = array(), $content = '');
    }

    /**
     * Generate the timestamp of the requested authentificatin server
     *
     * @return int
     */
    public function getTime()
    {
        return 1334778878;
        $datetime = new \DateTime('now + 10 MINUTES', new \DateTimeZone('America/New_York'));

        return $datetime->getTimestamp();
    }
}
