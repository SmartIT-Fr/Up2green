<?php

namespace Up2green\CommonBundle\Model;

use Up2green\CommonBundle\Model\om\BaseVoucher;
use Symfony\Component\Validator\ExecutionContext;

/**
 * Voucher entity
 */
class Voucher extends BaseVoucher
{
    protected $prefix;

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function preInsert(\PropelPDO $con = null)
    {
        if (empty($this->code)) {
            $this->setCode(VoucherQuery::getCodeUnused($this->prefix));
        }

        return parent::preInsert($con);
    }

    public function __toString()
    {
        return $this->code;
    }

    public static function isValid($voucher, ExecutionContext $context)
    {
        $result = VoucherQuery::create()->findOneByCode($voucher->getCode());
        if (empty($result)) {
            $context->addViolationAtSubPath('code', 'voucher_code_wrong', array(), null);
        }
    }

}
