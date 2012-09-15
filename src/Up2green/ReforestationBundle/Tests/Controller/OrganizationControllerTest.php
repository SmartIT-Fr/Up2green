<?php

namespace Up2green\ReforestationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * test the DefaultController of the BlogBundle
 */
class OrganizationControllerTest extends IsolatedWebTestCase
{
	function showProvider()
	{
		return array(
			array(200, 1),
			array(404, 5)
		);
	}
    /**
     * Test indexAction
     * 
     * @dataProvider showProvider
     */
    public function testShow($httpStatus, $id)
    {
        $this->client->request('GET', '/reforestation/organization/'.$id);
        $this->assertEquals($httpStatus, $this->client->getResponse()->getStatusCode());
    }
}
