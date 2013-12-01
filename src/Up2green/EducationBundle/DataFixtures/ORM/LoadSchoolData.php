<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\EducationBundle\Entity\School;

/**
 * Class LoadSchoolData
 */
class LoadSchoolData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $schoolCondamine = new School();
        $schoolCondamine->setName('Ecole primaire "Les Condamines"');
        $schoolCondamine->setAddress("Versailles, France");

        $manager->persist($schoolCondamine);
        $manager->flush();

        $this->addReference('school-condamine', $schoolCondamine);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 7;
    }
}