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
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $price;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $credit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_purchasable", type="boolean")
     */
    protected $isPurchasable = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_partner_only", type="boolean")
     */
    protected $isPartnerOnly = false;

    /**
     * @param integer $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return integer
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param boolean $isPartnerOnly
     */
    public function setIsPartnerOnly($isPartnerOnly)
    {
        $this->isPartnerOnly = $isPartnerOnly;
    }

    /**
     * @return boolean
     */
    public function getIsPartnerOnly()
    {
        return $this->isPartnerOnly;
    }

    /**
     * @param boolean $isPurchasable
     */
    public function setIsPurchasable($isPurchasable)
    {
        $this->isPurchasable = $isPurchasable;
    }

    /**
     * @return boolean
     */
    public function getIsPurchasable()
    {
        return $this->isPurchasable;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}
