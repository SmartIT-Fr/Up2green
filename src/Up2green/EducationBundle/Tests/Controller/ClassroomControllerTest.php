<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Classroom controller test
 */
class ClassroomControllerTest extends WebTestCase
{
    /**
     * test the show action
     */
    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/school/ecole-des-fans/ce1-a');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * test the show page with an inexistant classroom
     */
    public function testShowClassroomNotFound()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/school/titi/classroom_from_nowhere');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
