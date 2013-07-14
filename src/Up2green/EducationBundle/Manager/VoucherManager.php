<?php

namespace Up2green\EducationBundle\Manager;

use FOS\UserBundle\Propel\User;
use Up2green\EducationBundle\Model\EducationVoucher;
use Up2green\CommonBundle\Model\Voucher;

/**
 * Voucher manager class
 */
class VoucherManager
{
    /**
     * @return UploadedFile
     */
    public function generate(User $owner, $number)
    {
        if (!is_int($number)) {
            throw new \LogicException("Number parameter should be an integer");
        }

        $codes = array();

        for ($index = 0; $index < $number; $index++) {
            $commonVoucher = new Voucher();
            $commonVoucher->setowner($owner);

            $voucher = new EducationVoucher();
            $voucher->setVoucher($commonVoucher);
            $voucher->save();

            $codes[] = $voucher->getVoucher()->getCode();
        }

        return $codes;
    }
}
