<?php

namespace Up2green\CommonBundle\Tests\Controller;

use Up2green\CommonBundle\Test\WebTestCase;

/**
 * Test the LocaleControllerController of the CommonBundle
 */
class LocaleControllerTest extends WebTestCase
{
    /**
     * @return array
     */
    function languageProvider()
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
        $crawler = $this->client->request('GET', '/blog/article/1');

        $link    = $crawler->filter('a:contains("' . $language . '")')->eq(0)->link();
        $crawler = $this->client->click($link);
        $crawler = $this->client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('h2')->count());
    }
}
