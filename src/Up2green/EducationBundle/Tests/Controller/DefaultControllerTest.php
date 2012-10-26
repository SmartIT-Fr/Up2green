<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Default controller test
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * test the index action
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * test the theProject action
     */
    public function testTheProject()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/the-project');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
