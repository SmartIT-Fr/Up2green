<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
        $client = static::createClient();

        $client->setSubDomain('education');
        $client->request('GET', '/participate/teacher');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * Test the donation action
     */
    public function testDonation()
    {
        $client = static::createClient();

        $client->setSubDomain('education');
        $client->request('GET', '/participate/donation');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
