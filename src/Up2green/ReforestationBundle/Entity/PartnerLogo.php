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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image
     * @Gedmo\UploadableFileName
     */
    protected $src;

    /**
     * @ORM\Column(length=128, nullable=true)
     */
    protected $href;

    /**
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
}
