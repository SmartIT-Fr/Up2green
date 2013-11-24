<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class EducationVoucherRepository
 */
class EducationVoucherRepository extends EntityRepository
{
    /**
     * @return integer
     */
    public function countUsed()
    {
        return (int) $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->where('v.isActive = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
