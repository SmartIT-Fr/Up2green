<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\ReforestationBundle\Entity\Organization;

/**
 * Class LoadOrganizationData
 */
class LoadOrganizationData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $organizationTreesForTheFuture = new Organization();
        $organizationTreesForTheFuture->setTitle('Trees For The Future');
        $organizationTreesForTheFuture->setUrl('http://www.treesftf.org/');
        $organizationTreesForTheFuture->setSummary("<p>\r\n\t<span style=\"font-size: 11px;\">Since 1989, Trees for the Future has been helping communities around the world plant trees. Through seed distribution, agroforestry training, and our country programs, we have empowered rural groups to restore tree cover to their lands. Planting trees protects the environment and helps to preserve traditional livelihoods and cultures for generations.</span></p>\r\n");
        $organizationTreesForTheFuture->setDescription("<p>\r\n\t<span style=\"font-size: 11px;\">Our mission and history demonstrate how dedicated we are to sustainable agroforestry.</span></p>\r\n");
        $organizationTreesForTheFuture->setIsActive(true);

        $manager->persist($organizationTreesForTheFuture);
        $manager->flush();

        $this->addReference('organization-trees-for-the-future', $organizationTreesForTheFuture);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}