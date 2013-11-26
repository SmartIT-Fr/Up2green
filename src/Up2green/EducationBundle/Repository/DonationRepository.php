<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JMS\Payment\CoreBundle\Model\PaymentInterface;

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
            ->innerJoin('pi.payments', 'p')
            ->andWhere('p.state = :deposited')
            ->setParameter('deposited', PaymentInterface::STATE_DEPOSITED)
            ->orderBy('v.amount', 'DESC')
            ->addOrderBy('pi.createdAt', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
}
