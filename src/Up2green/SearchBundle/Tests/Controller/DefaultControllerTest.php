<?php

namespace Up2green\SearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test the Default controller
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test the index action
     */
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Test the search action
     *
     * @todo Test the displayed results
     * @todo Test all the search engine type
     * @todo Test GET action
     */
    public function testSearch()
    {
        $client = static::createClient();

        $client->request('POST', '/', array(
            'type' => 0,
            'q' => 'test',
        ));

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
