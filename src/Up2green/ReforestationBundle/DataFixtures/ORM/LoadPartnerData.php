<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\ReforestationBundle\Entity\Partner;

/**
 * Class LoadPartnerData
 */
class LoadPartnerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $partnerDyrup = new Partner();
        $partnerDyrup->setUser($this->getReference('user-partner-dyrup'));
        $partnerDyrup->setTitle('DYRUP');
        $partnerDyrup->setSummary("<p>\r\n\t<span style=\"font-size: 14px;\"><strong>DYRUP </strong>vous offre <strong>un arbre à planter </strong>sur la Planète parmi les programmes d'<strong>agroforesterie</strong><strong> </strong>qu'elle soutient en 2012 !</span></p>\r\n");
        $partnerDyrup->setUrl('http://dyrup.fr/');

        $manager->persist($partnerDyrup);
        $manager->flush();

        $this->addReference('partner-dyrup', $partnerDyrup);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}