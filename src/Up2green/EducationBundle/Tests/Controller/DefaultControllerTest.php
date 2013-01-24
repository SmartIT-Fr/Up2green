<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
