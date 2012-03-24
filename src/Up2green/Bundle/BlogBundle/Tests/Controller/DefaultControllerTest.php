<?php

namespace Up2green\Bundle\BlogBundle\Tests\Controller;

use Up2green\Bundle\CommonBundle\Test\IsolatedWebTestCase;

class DefaultControllerTest extends IsolatedWebTestCase
{
    public function testIndex()
    {
        $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
