<?php

namespace Up2green\EducationBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
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
     * @param User   $owner
     * @param int    $number
     * @param string $prefix
     *
     * @return array
     * @throws \LogicException
     */
    public function generate(User $owner, $number, $prefix = '')
    {
        if (!is_int($number)) {
            throw new \LogicException("Number parameter should be an integer");
        }

        $codes = array();
        $repository = $this->manager->getRepository('Up2greenCommonBundle:Voucher');

        for ($index = 0; $index < $number; $index++) {
            $voucher = new EducationVoucher();
            $voucher->setOwner($owner);
            $voucher->setCode($repository->getCodeUnused($prefix));

            $this->manager->persist($voucher);
            $this->manager->flush();

            $codes[] = $voucher->getCode();
        }

        return $codes;
    }
}
