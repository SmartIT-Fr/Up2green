<?php

namespace Up2green\ReforestationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test the Default controller
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test the indexAction
     */
    public function testIndex()
    {
        $client = static::createClient();

        $client->setSubDomain('reforestation');
        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
