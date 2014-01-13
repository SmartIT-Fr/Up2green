<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Up2green\UserBundle\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Partner entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="partner")
 * @UniqueEntity("user")
 */
class Partner
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
     * @var User
     *
     * @ORM\OneToOne(targetEntity="Up2green\UserBundle\Entity\User", cascade={"persist"}, inversedBy="partner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $user;

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
    protected $vouchers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Up2green\ReforestationBundle\Entity\PartnerLogo", cascade={"persist", "remove"}, mappedBy="partner")
     */
    protected $logos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
        $this->logos = new ArrayCollection();
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
     * @param \Doctrine\Common\Collections\ArrayCollection $vouchers
     */
    public function setVouchers($vouchers)
    {
        $this->vouchers = $vouchers;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVouchers()
    {
        return $this->vouchers;
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

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Up2green\UserBundle\Entity\User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Up2green\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $logos
     */
    public function setLogos($logos)
    {
        $this->logos = new ArrayCollection();

        foreach ($logos as $logo) {
            $this->addLogo($logo);
        }
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getLogos()
    {
        return $this->logos;
    }

    /**
     * @param PartnerLogo $logo
     */
    public function addLogo(PartnerLogo $logo)
    {
        if (!$this->logos->contains($logo)) {
            $this->logos->add($logo);
            $logo->setPartner($this);
        }
    }

    /**
     * @param PartnerLogo $logo
     */
    public function removeLogo(PartnerLogo $logo)
    {
        if ($this->logos->contains($logo)) {
            $this->logos->removeElement($logo);
        }
    }
}
