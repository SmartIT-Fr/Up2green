<?php

namespace Up2green\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * Article translations
 *
 * @ORM\Table(name="article_i18n", indexes={
 *      @ORM\Index(name="article_i18n_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class ArticleI18n extends AbstractTranslation
{
    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Up2green\BlogBundle\Entity\Article", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

    /**
     * @param Article $object
     */
    public function setObject(Article $object)
    {
        $this->object = $object;
    }

    /**
     * @return Article
     */
    public function getObject()
    {
        return $this->object;
    }
}
