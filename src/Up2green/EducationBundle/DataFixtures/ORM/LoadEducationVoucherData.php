<?php

namespace Up2green\ReforestationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Up2green\EducationBundle\Entity\EducationVoucher;

/**
 * Class LoadEducationVoucherData
 */
class LoadEducationVoucherData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $voucher1 = new EducationVoucher();
        $voucher1->setIsActive(false);
        $voucher1->setUser($this->getReference('user-teacher'));
        $voucher1->setCode('EDUCTEST1');

        $voucher2 = new EducationVoucher();
        $voucher2->setCode('EDUCTEST2');

        $voucher3 = new EducationVoucher();
        $voucher3->setCode('EDUCTEST3');

        $voucher4 = new EducationVoucher();
        $voucher4->setCode('EDUCTEST4');

        $voucher5 = new EducationVoucher();
        $voucher5->setCode('EDUCTEST5');

        $voucher6 = new EducationVoucher();
        $voucher6->setCode('EDUCTEST6');

        $voucher7 = new EducationVoucher();
        $voucher7->setCode('EDUCTEST7');

        $voucher8 = new EducationVoucher();
        $voucher8->setCode('EDUCTEST8');

        $voucher9 = new EducationVoucher();
        $voucher9->setCode('EDUCTEST9');

        $manager->persist($voucher1);
        $manager->persist($voucher2);
        $manager->persist($voucher3);
        $manager->persist($voucher4);
        $manager->persist($voucher5);
        $manager->persist($voucher6);
        $manager->persist($voucher7);
        $manager->persist($voucher8);
        $manager->persist($voucher9);
        $manager->flush();

        $this->addReference('voucher-1', $voucher1);
        $this->addReference('voucher-2', $voucher2);
        $this->addReference('voucher-3', $voucher3);
        $this->addReference('voucher-4', $voucher4);
        $this->addReference('voucher-5', $voucher5);
        $this->addReference('voucher-6', $voucher6);
        $this->addReference('voucher-7', $voucher7);
        $this->addReference('voucher-8', $voucher8);
        $this->addReference('voucher-9', $voucher9);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 6;
    }
}