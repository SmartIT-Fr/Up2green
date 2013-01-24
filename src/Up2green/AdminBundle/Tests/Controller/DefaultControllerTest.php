<?php

namespace Up2green\AdminBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Default controller test
 */
class DefaultControllerTest extends IsolatedWebTestCase
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
