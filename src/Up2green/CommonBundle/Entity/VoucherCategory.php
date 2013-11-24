<?php

namespace Up2green\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoucherCategory entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="voucher_category")
 */
class VoucherCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal")
     */
    protected $price;

    /**
     * @ORM\Column(type="integer")
     */
    protected $credit;

    /**
     * @ORM\Column(name="is_purchasable", type="boolean")
     */
    protected $isPurchasable = true;

    /**
     * @ORM\Column(name="is_partner_only", type="boolean")
     */
    protected $isPartnerOnly = false;
}
