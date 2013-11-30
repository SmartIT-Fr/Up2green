<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var string
     *
     * @ORM\Column()
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $summary;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $page;

    /**
     * @var string
     *
     * @ORM\Column(name="page_title", nullable=true)
     */
    protected $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    protected $certificate;

    /**
     * @var string
     *
     * @ORM\Column(length=150, nullable=true)
     */
    protected $url;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Up2green\ReforestationBundle\Entity\ReforestationVoucher")
     * @ORM\JoinTable(name="partner_voucher",
     *      joinColumns={@ORM\JoinColumn(name="partner_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="voucher_id", referencedColumnName="id")}
     * )
     */
    protected $partnerVouchers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * @param string $certificate
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * @return string
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $partnerVouchers
     */
    public function setPartnerVouchers($partnerVouchers)
    {
        $this->partnerVouchers = $partnerVouchers;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPartnerVouchers()
    {
        return $this->partnerVouchers;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
