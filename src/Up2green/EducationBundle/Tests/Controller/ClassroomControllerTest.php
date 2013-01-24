<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Classroom controller test
 */
class ClassroomControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the show action
     */
    public function testShow()
    {
        $client = static::createClient();

        $client->request('GET', '/education/school/ecole-primaire-les-condamines/ce2');

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
