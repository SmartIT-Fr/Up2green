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
     * Test defultAction of contact
     *
     * @param array $data Post datas
     */
    public function testDefault()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact/');

        $form = $crawler
            ->selectButton('Soumettre')
            ->form(array(
                'contact[first_name]' => 'Marie',
                'contact[last_name]' => 'Minassyan',
                'contact[subject]' => 'Test',
                'contact[email]' => 'marie.minassyan@up2green.com',
                'contact[message]' => 'Test message',
                'contact[captcha]' => '',
            ));

        $client->submit($form);

        $this->assertRegExp('/Mauvaise valeur pour le code visuel/', $client->getResponse()->getContent());
    }
}
