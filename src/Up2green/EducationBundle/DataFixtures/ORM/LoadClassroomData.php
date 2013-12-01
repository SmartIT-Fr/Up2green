<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\EducationBundle\Entity\Classroom;

/**
 * Class LoadClassroomData
 */
class LoadClassroomData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $classroomCondamineCE1 = new Classroom();
        $classroomCondamineCE1->setName('CE1');
        $classroomCondamineCE1->setYear(2011);
        $classroomCondamineCE1->setDescription("La classe de CE1 de l'école des Condamines a étudié cette année (2011/2012) la forêt et les écosystèmes forestiers. Chaque élève a dessiné un arbre selon différentes techniques. Les dessins correspondants sont présentés ici. En échange de leur contribution artistique, chaque enfant a pu choisir où planter un \"vrai\" arbre sur la Planète, dans l'un des 9 programmes de reforestation co-développés et soutenus par l'association Up2green Reforestation. Les élèves se sont ainsi connectés en classe sur la plate-forme de plantation en ligne de l'association et ont sélectionné sur la mapmonde intéractive le programme de leur choix, avant de recevoir une attestation à leur nom. Dans le cadre du projet, chaque enfant a également pris en photo un arbre de son choix en indiquant son essence et sa localisation. Ces photos ont été imprimées sur des T-shirt, puis ces derniers ont été mis en vente. Les quelques fonds ainsi collectés ont été reversés aux associations du WWF et GoodPlanet qui ont fourni pendant l'année des posters pédagogiques.");
        $classroomCondamineCE1->setSchool($this->getReference('school-condamine'));
        $classroomCondamineCE1->setPicture('/uploads/classrooms/1/photo.jpg');
        $classroomCondamineCE1->setUser($this->getReference('user-teacher'));

        $manager->persist($classroomCondamineCE1);
        $manager->flush();

        $this->addReference('classroom-condamine-ce1', $classroomCondamineCE1);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 8;
    }
}