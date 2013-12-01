<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PartnerLogo entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="partner_logo")
 * @Gedmo\Uploadable(pathMethod="getPath")
 */
class PartnerLogo
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
     * @var mixed
     *
     * @ORM\Column(nullable=true)
     * @Assert\Image
     * @Gedmo\UploadableFileName
     */
    protected $src;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    protected $href;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Partner", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $partner;

    /**
     * @return null
     */
    public function getPath()
    {
        return sprintf('/uploads/partners/%d/logos', $this->partner->getId());
    }

    /**
     * @param string $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
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
     * @param \Up2green\ReforestationBundle\Entity\Partner $partner
     */
    public function setPartner(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return \Up2green\ReforestationBundle\Entity\Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @param mixed $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return mixed
     */
    public function getSrc()
    {
        return $this->src;
    }
}
