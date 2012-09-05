<?php

namespace Up2green\ReforestationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the Default controller
 */
class DefaultControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the indexAction
     */
    public function testIndex()
    {
        $this->client->request('GET', '/reforestation/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
