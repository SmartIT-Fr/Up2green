<?php

namespace Up2green\CommonBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * test the ContactControllerController of the CommonBundle
 */
class ContactControllerTest extends IsolatedWebTestCase
{

    function contactProvider()
	{
		return array(
			array(
			    array(
				'first_name' => 'Marie',
				'last_name' => 'Minassyan',
				'subject' => 'test',
				'email' => 'marie.minassyan@up2green.com',
				'message' => 'test',
			    'captcha' => ''
                )
            )
		);
	}

    /**
     * Test defultAction of contact
     *
     * @dataProvider contactProvider
     */
    public function testDefault($data)
    {
        $crawler = $this->client->request('POST', '/contact/', $data);
        $this->assertGreaterThan(0, $crawler->filter('div.alert')->count());
    }
}
