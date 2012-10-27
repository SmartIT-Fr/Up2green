<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\WebTestCase;

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
        $this->client->request('GET', '/education/school/ecole-des-fans/ce1-a');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test the show page with an inexistant classroom
     */
    public function testShowClassroomNotFound()
    {
        $this->client->request('GET', '/education/school/titi/classroom_from_nowhere');

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
