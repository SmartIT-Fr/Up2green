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
     * Test the new action
     */
    public function testNew()
    {
        $this->client->request('GET', '/education/registration/new');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

//    /**
//     * Test the new action with a new school
//     */
//    public function testNewWithNewSchool()
//    {
//        $crawler = $this->client->request('GET', '/education/registration/new');
//        $form = $crawler
//            ->selectButton('submit')
//            ->form(array(
//                'education_registration[school][name]'                  => 'School of life',
//                'education_registration[school][address]'               => 'France, Paris',
//                'education_registration[account][username]'             => 'john.doe',
//                'education_registration[account][email]'                => 'john.doe@fromnowhere.out',
//                'education_registration[account][plainPassword][first]'      => 'myLiveIsASecretForMe',
//                'education_registration[account][plainPassword][second]'     => 'myLiveIsASecretForMe',
//                'education_registration[classroom][name]'               => 'CP1',
//                'education_registration[classroom][description]'        => 'This is the classroom of no one'
//            ))
//        ;
//
//        $form['education_registration[school][school]']->select('school_out');
//        $this->client->submit($form);
//
//        $this->assertTrue($this->client->getResponse()->isRedirect());
//    }
//
//    /**
//     * test the new action with an existing school
//     */
//    public function testNewExistingSchool()
//    {
//        $crawler = $this->client->request('GET', '/education/registration/new');
//
//        $form = $crawler
//            ->selectButton('submit')
//            ->form(array(
//                'education_registration[school][school_list]'           => SchoolQuery::create()->findOneBySlug('ecole-des-fans')->getId(),
//                'education_registration[account][username]'             => 'doe.john',
//                'education_registration[account][email]'                => 'doe.john@wherenofrom.out',
//                'education_registration[account][plainPassword][first]'      => 'ForMemyLiveIsASecret',
//                'education_registration[account][plainPassword][second]'     => 'ForMemyLiveIsASecret',
//                'education_registration[classroom][name]'               => '1PC',
//                'education_registration[classroom][description]'        => 'This is no one of the classroom'
//            ));
//
//        $form['education_registration[school][school]']->select('school_in');
//
//        $this->client->submit($form);
//
//        $this->assertTrue($this->client->getResponse()->isRedirect());
//    }
}
