<?php

namespace Up2green\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\UserBundle\Entity\User;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userTeacher = new User();
        $userTeacher->setUsername('condamine-teacher');
        $userTeacher->setPassword('up2test');
        $userTeacher->setEmail('webmaster@up2green.com');
        $userTeacher->setRoles(array('ROLE_USER', 'ROLE_TEACHER'));
        $userTeacher->setEnabled(true);

        $partnerDyrup = new User();
        $partnerDyrup->setUsername('dyrup');
        $partnerDyrup->setPassword('123456');
        $partnerDyrup->setEmail('contact@dyrup.fr');
        $partnerDyrup->setRoles(array('ROLE_USER', 'ROLE_PARTNER'));
        $partnerDyrup->setEnabled(true);

        $manager->persist($userTeacher);
        $manager->persist($partnerDyrup);
        $manager->flush();

        $this->addReference('user-teacher', $userTeacher);
        $this->addReference('user-partner-dyrup', $partnerDyrup);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}