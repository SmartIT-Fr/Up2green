<?php

namespace Up2green\Bundle\UserBundle\Tests\Controller;

use Up2green\Bundle\CommonBundle\Test\IsolatedWebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LocaleControllerTest extends IsolatedWebTestCase
{
    public function testChange()
    {
        $this->client->request('GET', '/user/change-language/en');
        $this->assertTrue($this->client->getResponse() instanceof RedirectResponse);
    }
}
