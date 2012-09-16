<?php

namespace Up2green\CommonBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * test the LocaleControllerController of the CommonBundle
 */
class LocaleControllerTest extends IsolatedWebTestCase
{

    function showProvider()
	{
		return array(
			array('French', 1),
			array('English', 1)
		);
	}

    /**
     * Test showAction on Article with locale switch
     *
     * @dataProvider showProvider
     */
    public function testShow($locale, $id)
    {
        $crawler = $this->client->request('GET', '/blog/article/'.$id);

        $link = $crawler->filter('a:contains("'.$locale.'")')->eq(0)->link();
        $crawler = $this->client->click($link);
        $crawler = $this->client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('h2')->count());
    }
}
