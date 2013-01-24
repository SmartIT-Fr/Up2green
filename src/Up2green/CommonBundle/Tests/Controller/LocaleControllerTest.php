<?php

namespace Up2green\CommonBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test the LocaleControllerController of the CommonBundle
 */
class LocaleControllerTest extends WebTestCase
{
    /**
     * @return array
     */
    public function languageProvider()
    {
        return array(
            array('Français'),
            array('Anglais')
        );
    }

    /**
     * Test locale switching
     *
     * @param string $language Requested language
     *
     * @dataProvider languageProvider
     */
    public function testSwitchLocale($language)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/article/1');

        $link    = $crawler->filter('a:contains("' . $language . '")')->eq(0)->link();
        $crawler = $client->click($link);
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('h2')->count());
    }
}
