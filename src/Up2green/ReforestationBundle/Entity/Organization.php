<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Organization entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="organization")
 * @Gedmo\TranslationEntity(class="Up2green\ReforestationBundle\Entity\OrganizationI18n")
 */
class Organization
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length=128)
     */
    protected $url;

    /**
     * @ORM\Column(length=128)
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $summary;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $description;

    /**
     * @ORM\Column(length=128)
     */
    protected $logo;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @ORM\OneToMany(
     *   targetEntity="Up2green\ReforestationBundle\Entity\OrganizationI18n",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param OrganizationI18n $t
     */
    public function addTranslation(OrganizationI18n $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }
}
