<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test the OrganizationController of the BlogBundle
 */
class OrganizationControllerTest extends WebTestCase
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

        $client->setSubDomain('association');
        $client->request('GET', sprintf('/organization/%d', $id));

        $this->assertEquals($httpStatus, $client->getResponse()->getStatusCode());
    }

    /**
     * Test listAction
     */
    public function testList()
    {
        $client = static::createClient();

        $client->setSubDomain('association');
        $crawler = $client->request('GET', '/organization/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(0, $crawler->filter('div.item')->count());
    }
}
