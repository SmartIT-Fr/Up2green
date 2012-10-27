<?php

namespace Up2green\CommonBundle\Model;

/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'voucher' table.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.src.Up2green.CommonBundle.Model
 */
class ReforestationVoucher extends Voucher
{
    /**
     * Constructs a new ReforestationVoucher class, setting the class_key
     * column to VoucherPeer::CLASSKEY_2.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setClassKey(VoucherPeer::CLASSKEY_2);
    }

} // ReforestationVoucher
