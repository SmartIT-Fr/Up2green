<?php

namespace Up2green\Bundle\SearchBundle\Tests\Controller;

use Up2green\Bundle\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the Defaultcontroller 
 */
class DefaultControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the indexAction 
     */
    public function testIndex()
    {
        $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
