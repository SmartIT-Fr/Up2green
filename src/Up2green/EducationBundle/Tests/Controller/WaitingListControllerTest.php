<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the WaitingListControllerTest of the EducationBundle
 *
 * @todo Find a way to pass the captcha validation
 */
class WaitingListControllerTest extends IsolatedWebTestCase
{
    /**
     * @return array
     */
    function waitingListProvider()
    {
        return array(
            array(
                array(
                    'first_name'     => 'Marie',
                    'last_name'      => 'Minassyan',
                    'email'          => 'marie.minassyan@up2green.com',
                    'phone_number'   => '0667075579',
                    'kits_number'    => '2',
                    'address'		 => array(
                        'name'   		 => 'Maison',
                        'street_line_1'  => '12 bd Edgar Quinet',
                        'street_line_2'  => ' ',
                        'zipcode'   	 => '75014',
                        'city'   		 => 'Paris',
                        'country'        => 'France'
                    ),
                    'captcha'        => ''
                )
            )
        );
    }

    /**
     * Test defultAction of contact
     *
     * @param array $data Post datas
     *
     * @dataProvider waitingListProvider
     */
    public function testJoin(array $data)
    {
        $this->client->request('POST', '/education/waitinglist/join', $data);
        $this->assertRegExp('/Bad code value/', $this->client->getResponse()->getContent());
    }
}
