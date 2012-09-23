<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/registration/new');

        $this->assertTrue($client->getResponse()->isOk());
    }

    public function testNewRegistrationWithGoodData()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/education/registration/new');
        $form = $crawler
            ->selectButton('submit')
            ->form(array(
                'education_registration[school][name]'                  => 'School of life',
                'education_registration[school][address]'               => 'France, Paris',
                'education_registration[account][username]'             => 'john.doe',
                'education_registration[account][firstname]'            => 'John',
                'education_registration[account][lastname]'             => 'Doe',
                'education_registration[account][email]'                => 'john.doe@fromnowhere.out',
                'education_registration[account][password][first]'      => 'myLiveIsASecretForMe',
                'education_registration[account][password][second]'     => 'myLiveIsASecretForMe',
                'education_registration[classroom][name]'               => 'CP1',
                'education_registration[classroom][description]'        => 'This is the classroom of no one'
            ))
        ;
        $form['education_registration[school][school]']->select('school_out');
        $client->submit($form);
        print($client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}
