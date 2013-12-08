<?php

namespace Up2green\ReforestationBundle\Entity;

use A2lix\TranslationFormBundle\Util\GedmoTranslatable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Program entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="program")
 * @Gedmo\TranslationEntity(class="Up2green\ReforestationBundle\Entity\ProgramI18n")
 * @Gedmo\Uploadable(filenameGenerator="ALPHANUMERIC", appendNumber=true ,pathMethod="getPath")
 */
class Program
{
    use GedmoTranslatable;

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
     * @Gedmo\UploadableFileName
     */
    protected $logo;

    /**
     * @var UploadedFile
     *
     * @Assert\Image
     */
    protected $logoFile;

    /**
     * @var boolean
     */
    protected $removeLogo;

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
     *   mappedBy="foreignKey",
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
     * @param \Up2green\ReforestationBundle\Entity\UploadedFile $logoFile
     */
    public function setLogoFile($logoFile)
    {
        $this->logoFile = $logoFile;
    }

    /**
     * @return \Up2green\ReforestationBundle\Entity\UploadedFile
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

    /**
     * @param boolean $removeLogo
     */
    public function setRemoveLogo($removeLogo)
    {
        $this->removeLogo = $removeLogo;
    }

    /**
     * @return boolean
     */
    public function getRemoveLogo()
    {
        return $this->removeLogo;
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

    /**
     * @param $defaultPath
     *
     * @return string
     */
    public function getPath($defaultPath = '')
    {
        return $defaultPath.'/uploads/programs';
    }
}
