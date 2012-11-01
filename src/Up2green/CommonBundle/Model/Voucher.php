<?php

namespace Up2green\CommonBundle\Model;

use Up2green\CommonBundle\Model\om\BaseVoucher;
use Symfony\Component\Validator\ExecutionContext;

/**
 * Voucher entity
 */
abstract class Voucher extends BaseVoucher
{
    public static function isValid($voucher, ExecutionContext $context)
    {
        $result = VoucherQuery::create()->findOneByCode($voucher->getCode());
        if (empty($result)) {
            $context->addViolationAtSubPath('code', 'voucher_code_wrong', array(), null);
        }
    }
}
