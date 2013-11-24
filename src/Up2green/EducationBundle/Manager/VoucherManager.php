<?php

namespace Up2green\EducationBundle\Manager;

use Up2green\EducationBundle\Entity\EducationVoucher;
use Up2green\UserBundle\Entity\User;

/**
 * Voucher manager class
 */
class VoucherManager
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return array
     */
    public function generate(User $owner, $number)
    {
        if (!is_int($number)) {
            throw new \LogicException("Number parameter should be an integer");
        }

        $codes = array();

        for ($index = 0; $index < $number; $index++) {
            $voucher = new EducationVoucher();
            $voucher->setowner($owner);

            $this->manager->persist($voucher);
            $this->manager->flush($voucher);

            $codes[] = $voucher->getVoucher()->getCode();
        }

        return $codes;
    }
}
