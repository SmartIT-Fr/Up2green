<?php

namespace Up2green\Bundle\CommonBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Isolated Web Test Case
 */
class IsolatedWebTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @see http://www.phpunit.de/manual/3.0/en/fixtures.html#fixtures.more-setup-than-teardown
     */
    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    /**
     * @see http://www.phpunit.de/manual/3.0/en/fixtures.html#fixtures.more-setup-than-teardown 
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
