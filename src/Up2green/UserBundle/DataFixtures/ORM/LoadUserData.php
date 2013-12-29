<?php

namespace Up2green\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Up2green\UserBundle\Entity\User;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $userTeacher  = $userManager->createUser();
        $partnerDyrup = $userManager->createUser();
        $simpleUser   = $userManager->createUser();

        $userTeacher->setUsername('condamine-teacher');
        $userTeacher->setPlainPassword('up2test');
        $userTeacher->setEmail('webmaster@up2green.com');
        $userTeacher->setRoles(array('ROLE_USER', 'ROLE_TEACHER'));
        $userTeacher->setEnabled(true);

        $partnerDyrup->setUsername('dyrup');
        $partnerDyrup->setPlainPassword('123456');
        $partnerDyrup->setEmail('contact@dyrup.fr');
        $partnerDyrup->setRoles(array('ROLE_USER', 'ROLE_PARTNER'));
        $partnerDyrup->setEnabled(true);

        $simpleUser->setUsername('simple-user');
        $simpleUser->setPlainPassword('123456');
        $simpleUser->setEmail('simple@user.fr');
        $simpleUser->setRoles(array('ROLE_USER'));
        $simpleUser->setEnabled(true);

        $userManager->updateUser($userTeacher, true);
        $userManager->updateUser($partnerDyrup, true);
        $userManager->updateUser($simpleUser, true);

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