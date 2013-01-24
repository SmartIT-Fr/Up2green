<?php

namespace Up2green\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Default controller test
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test the index action
     */
    public function testIndex()
    {
        $client = static::createClient();

        $client->connect('admin', 'adminpass');
        $client->request('GET', '/admin/');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
