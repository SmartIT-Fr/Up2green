<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class ClassroomPictureRepository
 */
class ClassroomPictureRepository extends EntityRepository
{
    /**
     * @return ArrayCollection
     */
    public function findAllForHomepage()
    {
        return $this->createQueryBuilder('cp')
            ->orderBy('cp.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->createQueryBuilder('cp')
            ->select('COUNT(cp.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
