<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $organization;

    /**
     * @var string
     *
     * @ORM\Column(length=128)
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $summary;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    protected $logo;

    /**
     * @var string
     *
     * @ORM\Column(nullable=true)
     */
    protected $geoaddress;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="max_tree")
     */
    protected $maxTree;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="added_trees")
     */
    protected $addedTrees = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", name="is_active")
     */
    protected $isActive = true;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *   targetEntity="Up2green\ReforestationBundle\Entity\ProgramI18n",
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
     * @param ProgramI18n $t
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

    /**
     * @param int $addedTrees
     */
    public function setAddedTrees($addedTrees)
    {
        $this->addedTrees = $addedTrees;
    }

    /**
     * @return int
     */
    public function getAddedTrees()
    {
        return $this->addedTrees;
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
     * @param string $geoaddress
     */
    public function setGeoaddress($geoaddress)
    {
        $this->geoaddress = $geoaddress;
    }

    /**
     * @return string
     */
    public function getGeoaddress()
    {
        return $this->geoaddress;
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
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param int $maxTree
     */
    public function setMaxTree($maxTree)
    {
        $this->maxTree = $maxTree;
    }

    /**
     * @return int
     */
    public function getMaxTree()
    {
        return $this->maxTree;
    }

    /**
     * @param \Up2green\ReforestationBundle\Entity\Organization $organization
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;
    }

    /**
     * @return \Up2green\ReforestationBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
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
}
