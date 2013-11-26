<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * Organization translations
 *
 * @ORM\Table(name="organization_i18n", indexes={
 *      @ORM\Index(name="organization_i18n_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class OrganizationI18n extends AbstractTranslation
{
    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Organization", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

    /**
     * @param Organization $object
     */
    public function setObject(Organization $object)
    {
        $this->object = $object;
    }

    /**
     * @return Organization
     */
    public function getObject()
    {
        return $this->object;
    }
}
