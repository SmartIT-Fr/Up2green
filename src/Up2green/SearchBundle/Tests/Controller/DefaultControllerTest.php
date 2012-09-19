<?php

namespace Up2green\SearchBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;

/**
 * Test the Default controller
 */
class DefaultControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the index action
     */
    public function testIndex()
    {
        $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    /**
     * Test the search action
     *
     * @todo Test the displayed results
     * @todo Test all the search engine type
     * @todo Test GET action
     */
    public function testSearch()
    {
        $this->client->request('POST', '/', array(
            'type' => 0,
            'q' => 'test',
        ));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
