<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ClassroomRepository
 */
class ClassroomRepository extends EntityRepository
{
    /**
     * @param array $filters
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createFilteredQueryBuilder(array $filters)
    {
        $query = $this->createQueryBuilder('c');

        foreach ($filters as $key => $filter) {
            $query->andWhere(sprintf('%s = :filter_%d', $filter['name'], $key));
            $query->setParameter(sprintf('filter_%d', $key), $filter['value']);
        }

        return $query;
    }
}
