<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * test the DefaultController of the BlogBundle
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test indexAction
     */
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/blog/');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
