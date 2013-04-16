<?php

namespace Up2green\EducationBundle\Tests\Controller;

use Up2green\CommonBundle\Test\IsolatedWebTestCase;
use Up2green\EducationBundle\Model\SchoolQuery;

/**
 * Registration controller test
 */
class RegistrationControllerTest extends IsolatedWebTestCase
{
    /**
     * Test the new action with a new school
     */
    public function testNewWithNewSchool()
    {
        $client = static::createClient();

        $client->setSubDomain('education');
        $crawler = $client->request('GET', '/registration/new/EDUCTEST8');

        $form = $crawler
            ->selectButton('Accéder à mon espace')
            ->form(array(
                'education_registration[school][name]'                   => 'School of life',
                'education_registration[school][address]'                => 'France, Paris',
                'education_registration[account][username]'              => 'john.doe',
                'education_registration[account][email]'                 => 'john.doe@fromnowhere.out',
                'education_registration[account][plainPassword][first]'  => 'myLiveIsASecretForMe',
                'education_registration[account][plainPassword][second]' => 'myLiveIsASecretForMe',
                'education_registration[classroom][name]'                => 'CP1',
                'education_registration[classroom][description]'         => 'This is the classroom of no one'
            ));

        $form['education_registration[school][school]']->select('school_out');
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());

        $client->followRedirect();

        $this->assertRegExp('/Votre compte a été créé avec succès !/', $client->getResponse()->getContent());
    }

    /**
     * test the new action with an existing school
     */
    public function testNewExistingSchool()
    {
        $client = static::createClient();

        $client->setSubDomain('education');
        $crawler = $client->request('GET', '/registration/new/EDUCTEST9');

        $form = $crawler
            ->selectButton('Accéder à mon espace')
            ->form(array(
                'education_registration[school][schoolList]'             => 1,
                'education_registration[account][username]'              => 'doe.john',
                'education_registration[account][email]'                 => 'doe.john@wherenofrom.out',
                'education_registration[account][plainPassword][first]'  => 'ForMemyLiveIsASecret',
                'education_registration[account][plainPassword][second]' => 'ForMemyLiveIsASecret',
                'education_registration[classroom][name]'                => '1PC',
                'education_registration[classroom][description]'         => 'This is no one of the classroom'
            ));

        $form['education_registration[school][school]']->select('school_in');

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());

        $client->followRedirect();

        $this->assertRegExp('/Votre compte a été créé avec succès !/', $client->getResponse()->getContent());
    }

    /**
     * test the new action with an existing school
     */
    public function testExistingUsernameAndEmailDoNotGenerateAnException()
    {
        $client = static::createClient();

        $client->setSubDomain('education');
        $crawler = $client->request('GET', '/registration/new/EDUCTEST7');

        $form = $crawler
            ->selectButton('Accéder à mon espace')
            ->form(array(
                'education_registration[school][schoolList]'             => 1,
                'education_registration[account][username]'              => 'doe.john',
                'education_registration[account][email]'                 => 'doe.john@wherenofrom.out',
                'education_registration[account][plainPassword][first]'  => 'ForMemyLiveIsASecret',
                'education_registration[account][plainPassword][second]' => 'ForMemyLiveIsASecret',
                'education_registration[classroom][name]'                => '1PC',
                'education_registration[classroom][description]'         => 'This is no one of the classroom'
            ));

        $form['education_registration[school][school]']->select('school_in');

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertRegExp('/utilisateur est déjà utilisé/', $client->getResponse()->getContent());
        $this->assertRegExp('/adresse e-mail est déjà utilisée/', $client->getResponse()->getContent());
    }
}
