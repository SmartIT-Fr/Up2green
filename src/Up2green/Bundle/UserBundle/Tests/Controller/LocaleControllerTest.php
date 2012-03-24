<?php

namespace Up2green\Bundle\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LocaleControllerTest extends WebTestCase
{
    public function testChange()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user/change-language/en');

        $this->assertEquals(200, $client->getResponse()->getStatus());
    }
}
