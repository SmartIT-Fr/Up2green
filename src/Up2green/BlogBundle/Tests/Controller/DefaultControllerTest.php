<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

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
        $this->client->request('GET', '/blog/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
