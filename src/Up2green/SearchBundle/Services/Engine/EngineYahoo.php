<?php

namespace Up2green\SearchBundle\Services\Engine;

use Up2green\SearchBundle\Services\Engine\EngineInterface;
use Up2green\SearchBundle\Services\Engine\Engine as BaseEngine;
use Up2green\SearchBundle\Buzz\Browser\YahooBrowser;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Engine web class
 * Retrieve the web results
 */
class EngineYahoo extends BaseEngine implements EngineInterface
{
    protected $browser;
    protected $url;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext
     * @param YahooBrowser    $browser
     * @param string          $url
     */
    public function __construct(SecurityContext $securityContext, YahooBrowser $browser, $url)
    {
        $this->browser = $browser;
        $this->url = $url;

        parent::__construct($securityContext);
    }

    /**
     * return the results as array
     *
     * @return array
     */
    public function getResults()
    {
        $response = $this->browser->get($this->url);
//        die(var_dump($response->getContent()));
        return $response->getContent();
    }
}