<?php

namespace Up2green\AdminBundle\Tests\Controller;

use Up2green\CommonBundle\Test\WebTestCase;

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
        $this->client->connect('admin', 'adminpass');
        $this->client->request('GET', '/admin/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
