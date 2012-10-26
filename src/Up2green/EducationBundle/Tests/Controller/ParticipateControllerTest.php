<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Participate controller test
 */
class ParticipateControllerTest extends WebTestCase
{
    /**
     * test the teacher action
     */
    public function testTeacher()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/participate/teacher');

        $this->assertTrue($client->getResponse()->isOk());
    }

    /**
     * test the donation action
     */
    public function testDonation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/participate/donation');

        $this->assertTrue($client->getResponse()->isOk());
    }
}
