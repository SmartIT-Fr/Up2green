<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DonationRepository
 */
class DonationRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findGreatestValid()
    {
        return $this->createQueryBuilder('v')
            ->innerJoin('v.paymentInstruction', 'pi')
            ->innerJoin('pi.payment', 'p')
            ->andWhere('pi.state = :valid')
            ->andWhere('p.state = :deposited')
            ->setParameter('deposited', 'deposited')
            ->setParameter('valid', 'valid')
            ->orderBy('v.amount', 'DESC')
            ->addOrderBy('pi.createdAt', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
}
