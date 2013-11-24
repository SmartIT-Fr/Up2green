<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Up2green\UserBundle\Entity\User;

/**
 * Partner entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="partner")
 */
class Partner extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user;

    /**
     * @ORM\Column()
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $page;

    /**
     * @ORM\Column(name="page_title", nullable=true)
     */
    protected $pageTitle;

    /**
     * @ORM\Column(length=128, nullable=true)
     */
    protected $certificate;

    /**
     * @ORM\Column(length=150, nullable=true)
     */
    protected $url;

    /**
     * @ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\ReforestationVoucher")
     * @JoinTable(name="partner_voucher",
     *      joinColumns={@JoinColumn(name="partner_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="voucher_id", referencedColumnName="id")}
     * )
     */
    protected $vouchers;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }
}
