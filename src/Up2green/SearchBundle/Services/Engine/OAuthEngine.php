<?php

namespace Up2green\SearchBundle\Services\Engine;

use Up2green\SearchBundle\Services\Engine\OAuthEngineInterface;

/**
 * Engine web class
 * Retrieve the web results
 */
class OAuthEngine implements OAuthEngineInterface
{
    protected $url;
    protected $key;
    protected $secret;
    protected $query;

    /**
     * Constructor
     *
     * @param string $key    The consumer key
     * @param string $secret The consumer secret
     * @param string $url    The api url
     */
    public function __construct($key, $secret, $url)
    {
        $this->url = $url;
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * @param sring $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * Return the results as array
     *
     * @return array
     */
    public function getResults()
    {
        $args = array(
            'q'      => $this->query,
            'format' => 'json',
            'count'  => 20,
            'start'  => 0,
            'market' => 'fr-fr'
        );

        $consumer = new \OAuthConsumer($this->key, $this->secret);
        $request  = \OAuthRequest::from_consumer_and_token($consumer, null, "GET", $this->url, $args);

        // WTF FIXME : trick to fix the oauth timestamp
        $refDate = new \DateTime();
        if ($refDate->getTimezone()->getName() == 'Europe/Paris') {
            $timestamp = $request->get_parameter('oauth_timestamp');
            $timestamp += 1500;
            $request->set_parameter('oauth_timestamp', $timestamp, false);
        }

        $request->sign_request(new \OAuthSignatureMethod_HMAC_SHA1(), $consumer, null);

        $url = sprintf("%s?%s", $this->url, \OAuthUtil::build_http_query($args));

        $ch = curl_init();
        $headers = array($request->to_header());

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $rsp = curl_exec($ch);
        $response = json_decode($rsp, true);
        $return = array();

        if (
            !empty($response)
            && $response['bossresponse']['responsecode'] == '200'
            && $response['bossresponse']['web']['totalresults'] > 0
        ) {
          $return = $response['bossresponse']['web']['results'];
        }

        return $return;
    }
}