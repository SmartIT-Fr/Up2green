<?php

namespace Up2green\EducationBundle\Tests\Controller;

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

        $client->request('GET', '/education/');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * Test the theProject action
     */
    public function testTheProject()
    {
        $client = static::createClient();
        
        $client->request('GET', '/education/the-project');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
