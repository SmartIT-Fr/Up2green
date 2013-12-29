<?php

namespace Up2green\ReforestationBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ProgramRepository
 */
class ProgramRepository extends EntityRepository
{
    /**
     * @param array $filters
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findLatestForHomepage()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->setMaxResults(5)
            ->getResult();
    }
}
