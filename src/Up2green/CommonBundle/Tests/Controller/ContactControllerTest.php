<?php

namespace Up2green\CommonBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the ContactControllerController of the CommonBundle
 *
 * @todo Find a way to pass the captcha validation
 */
class ContactControllerTest extends IsolatedWebTestCase
{
    /**
     * @return array
     */
    function contactProvider()
    {
        return array(
            array(
                array(
                    'first_name' => 'Marie',
                    'last_name'  => 'Minassyan',
                    'subject'    => 'test',
                    'email'      => 'marie.minassyan@up2green.com',
                    'message'    => 'test',
                    'captcha'    => ''
                )
            )
        );
    }

    /**
     * Test defultAction of contact
     *
     * @param array $data Post datas
     *
     * @dataProvider contactProvider
     */
    public function testDefault(array $data)
    {
        $crawler = $this->client->request('POST', '/contact/', $data);
        $this->assertGreaterThan(0, $crawler->filter('div.alert')->count());
    }
}
