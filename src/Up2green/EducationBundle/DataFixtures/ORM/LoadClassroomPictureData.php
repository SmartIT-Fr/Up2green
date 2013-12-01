<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\EducationBundle\Entity\ClassroomPicture;

/**
 * Class LoadClassroomPictureData
 */
class LoadClassroomPictureData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $names = array(
        'Adam', 'Agathe', 'Alix', 'Beatrice', 'Camille', 'Capucine', 'Esteban', 'Evaelle', 'Ilame', 'Ines', 'Jean',
        'Julien', 'Juliette', 'Luna', 'Paul', 'Rémi', 'Yohan', 'Zoé', 'Adam', 'Adam', 'Adam', 'Agathe', 'Agathe',
        'Agathe', 'Agathe', 'Alix', 'Alix', 'Alix', 'Alix', 'Béatrice', 'Béatrice', 'Camille', 'Camille', 'Camille',
        'Camille', 'Capucine', 'Capucine', 'Esteban', 'Esteban', 'Esteban', 'Evaelle', 'Evaelle', 'Ilame', 'Ilame',
        'Ilame', 'Ines', 'Ines', 'Ines', 'Ines', 'Jean', 'Jean', 'Jean', 'Jean', 'Juliette', 'Juliette', 'Juliette',
        'Luna', 'Luna', 'Luna', 'Paul', 'Paul', 'Paul', 'Rémi', 'Rémi', 'Yohan', 'Yohan', 'Yohan', 'Yohan', 'Zoé',
        'Zoé', 'Zoé'
    );

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->names as $id => $name) {
            $picture = new ClassroomPicture();
            $picture->setClassroom($this->getReference('classroom-condamine-ce1'));
            $picture->setProgram($this->getReference('program-costa-rica'));
            $picture->setPicture(sprintf('/uploads/classrooms/1/pictures/%d.jpg', $id + 1));
            $picture->setStudent($name);

            $manager->persist($picture);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 9;
    }
}