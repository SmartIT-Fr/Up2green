<?php

namespace Up2green\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="article")
 * @Gedmo\Uploadable(path="/uploads/articles")
 * @Gedmo\TranslationEntity(class="Up2green\BlogBundle\Entity\ArticleI18n")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @Gedmo\Translatable
     */
    protected $summary;

    /**
     * @ORM\Column(type="text")
     * @Gedmo\Translatable
     */
    protected $description;

    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image
     * @Gedmo\UploadableFileName
     */
    protected $logo;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(unique=true)
     */
    protected $slug;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive = true;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

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
    public function addTranslation(ArticleI18n $t)
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
        return $this->id === null ? "New article" : (string) $this->getTitle();
    }
}
