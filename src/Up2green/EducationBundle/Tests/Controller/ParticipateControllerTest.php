<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\WebTestCase;

/**
 * Participate controller test
 */
class ParticipateControllerTest extends WebTestCase
{
    /**
     * Test the teacher action
     */
    public function testTeacher()
    {
        $this->client->request('GET', '/education/participate/teacher');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test the donation action
     */
    public function testDonation()
    {
        $this->client->request('GET', '/education/participate/donation');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
