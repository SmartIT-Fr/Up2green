<?php

namespace Up2green\BlogBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * test the ArticleController of the BlogBundle
 */
class ArticleControllerTest extends IsolatedWebTestCase
{
	function showProvider()
	{
		return array(
			array(200, 1),
			array(404, 5)
		);
	}

    /**
     * Test showAction
     *
     * @dataProvider showProvider
     */
    public function testShow($httpStatus, $id)
    {
        $this->client->request('GET', '/blog/article/'.$id);
        $this->assertEquals($httpStatus, $this->client->getResponse()->getStatusCode());
    }
}
