<?php

namespace Up2green\EducationBundle\Repository;

use Doctrine\ORM\EntityRepository;
use JMS\Payment\CoreBundle\Model\PaymentInterface;
use JMS\Payment\CoreBundle\Model\PaymentInstructionInterface;

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
            ->andWhere('pi.state = :valid')
            ->andWhere('p.state = :deposited')
            ->setParameter('deposited', PaymentInterface::STATE_DEPOSITED)
            ->setParameter('valid', PaymentInstructionInterface::STATE_VALID)
            ->orderBy('v.amount', 'DESC')
            ->addOrderBy('pi.createdAt', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }
}
