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

        $client->setSubDomain('association');
        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
