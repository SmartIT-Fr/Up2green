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
}
