<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Program entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="program")
 * @Gedmo\TranslationEntity(class="Up2green\ReforestationBundle\Entity\ProgramI18n")
 */
class Program
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $organization;

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
     * @ORM\Column(length=128, nullable=true)
     */
    protected $logo;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $geoaddress;

    /**
     * @ORM\Column(type="integer", name="max_tree")
     */
    protected $maxTree;

    /**
     * @ORM\Column(type="integer", name="added_trees")
     */
    protected $addedTrees = 0;

    /**
     * @ORM\Column(type="boolean", name="is_active")
     */
    protected $isActive = 0;

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
    public function addTranslation(ProgramI18n $t)
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
