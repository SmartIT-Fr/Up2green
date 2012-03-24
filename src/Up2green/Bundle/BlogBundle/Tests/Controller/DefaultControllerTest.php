<?php

namespace Up2green\Bundle\BlogBundle\Tests\Controller;

use Up2green\Bundle\CommonBundle\Test\IsolatedWebTestCase;

/**
 * test the DefaultController of the BlogBundle
 */
class DefaultControllerTest extends IsolatedWebTestCase
{
    /**
     * Test indexAction
     */
    public function testIndex()
    {
        $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
