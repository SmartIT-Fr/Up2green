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

    /**
     * @param \PropelPDO $con
     *
     * @return boolean
     */
    public function preInsert(\PropelPDO $con = null)
    {
        if (empty($this->code)) {
            $this->setCode(VoucherQuery::getCodeUnused($this->prefix));
        }

        return parent::preInsert($con);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }

    /**
     * @param Voucher          $voucher
     * @param ExecutionContext $context
     */
    public static function isValid(Voucher $voucher, ExecutionContext $context)
    {
        $isValid = VoucherQuery::create()->canBeUsed($voucher->getCode());

        if (!$isValid) {
            $context->addViolationAtSubPath('code', 'voucher_code_wrong', array(), null);
        }
    }

}
