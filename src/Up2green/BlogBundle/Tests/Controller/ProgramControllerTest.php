<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the ProgramController of the BlogBundle
 */
class ProgramControllerTest extends IsolatedWebTestCase
{
    /**
     * @return array
     */
    public function showProvider()
    {
        return array(
            array(200, 1),
            array(404, 42)
        );
    }

    /**
     * Test showAction
     *
     * @param integer $httpStatus Expected HTTP status code
     * @param integer $id         Requested id
     *
     * @dataProvider showProvider
     */
    public function testShow($httpStatus, $id)
    {
        $client = static::createClient();

        $client->request('GET', '/blog/program/' . $id);

        $this->assertEquals($httpStatus, $client->getResponse()->getStatusCode());
    }

    /**
     * Test listAction
     */
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/program/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('div.item')->count());
    }
}
