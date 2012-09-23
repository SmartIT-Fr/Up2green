<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClassroomControllerTest extends WebTestCase
{
    public function testShowAClassroomPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/school/ecole-des-fans/ce1-a');

        $this->assertTrue($client->getResponse()->isOk());
    }

    public function testShowAnInexistantClassroomPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/school/titi/classroom_from_nowhere');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
