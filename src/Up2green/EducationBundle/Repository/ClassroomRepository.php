<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

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
            $this->filterQuery($query, 'c', $key, $filter);
        }

        return $query;
    }

    /**
     * @param QueryBuilder $qb
     * @param string       $root
     * @param string       $key
     * @param mixed        $value
     *
     * @return QueryBuilder
     */
    protected function filterQuery(QueryBuilder $qb, $root, $key, $value)
    {
        if (null === $value) {

            return $qb;
        } elseif (is_array($value)) {
            $qb->leftJoin($root.'.'.$key, $root.'_'.$key);
            foreach ($value as $subKey => $subFilter) {
                $this->filterQuery($qb, $root.'_'.$key, $subKey, $subFilter);
            }
        } else {
            $qb->andWhere(sprintf('%s.%s = :filter_%d', $root, $key, $key));
            $qb->setParameter(sprintf('filter_%d', $key), $value);
        }

        return $qb;
    }
}
