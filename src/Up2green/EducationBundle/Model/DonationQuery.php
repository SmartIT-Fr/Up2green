<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseDonationQuery;

class DonationQuery extends BaseDonationQuery
{
    public function findGreatestValid()
    {
        return $this
            ->useOrderQuery()
                ->usePaymentInstructionQuery()
                    ->usePaymentQuery()
                        ->filterByState('deposited')
                    ->endUse()
                    ->filterByState('valid')
                    ->orderByCreatedAt(\Criteria::DESC)
                ->endUse()
                ->orderByAmount(\Criteria::DESC)
            ->endUse()
            ->limit(20)
            ->find();
    }
}
