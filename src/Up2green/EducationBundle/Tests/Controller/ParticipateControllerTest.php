<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Participate controller test
 */
class ParticipateControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the teacher action
     */
    public function testTeacher()
    {
        $client = static::createClient();

        $client->request('GET', '/education/participate/teacher');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * Test the donation action
     */
    public function testDonation()
    {
        $client = static::createClient();
        
        $client->request('GET', '/education/participate/donation');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
