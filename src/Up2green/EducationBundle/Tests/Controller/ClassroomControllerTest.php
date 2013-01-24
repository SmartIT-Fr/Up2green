<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Classroom controller test
 */
class ClassroomControllerTest extends WebTestCase
{
    /**
     * Test the show action
     */
    public function testShow()
    {
        $client = static::createClient();

        $client->request('GET', '/education/school/ecole-primaire-les-condamines/ce1');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Test the show page with an inexistant classroom
     */
    public function testShowClassroomNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/education/school/titi/classroom_from_nowhere');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
