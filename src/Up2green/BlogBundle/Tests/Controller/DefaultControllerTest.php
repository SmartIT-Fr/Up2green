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
        $client = static::createClient();

        $client->request('GET', '/blog/');

        echo $client->getResponse()->getContent();

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
