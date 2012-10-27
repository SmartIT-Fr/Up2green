<?php

namespace Up2green\CommonBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

/**
 * Web Test Case
 */
class WebTestCase extends BaseWebTestCase
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
