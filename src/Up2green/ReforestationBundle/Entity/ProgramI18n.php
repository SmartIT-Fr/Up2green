<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * Program translations
 *
 * @ORM\Table(name="program_i18n", indexes={
 *      @ORM\Index(name="program_i18n_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass="Gedmo\Translatable\Entity\Repository\TranslationRepository")
 */
class ProgramI18n extends AbstractTranslation
{
    /**
     * @var Program
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;

    /**
     * @param Program $object
     */
    public function setObject(Program $object)
    {
        $this->object = $object;
    }

    /**
     * @return Program
     */
    public function getObject()
    {
        return $this->object;
    }
}
