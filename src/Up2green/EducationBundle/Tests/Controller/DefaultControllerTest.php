<?php

namespace Up2green\EducationBundle\Tests\Controller;

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
        $this->client->request('GET', '/education/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test the theProject action
     */
    public function testTheProject()
    {
        $this->client->request('GET', '/education/the-project');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
