<?php

namespace Up2green\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallery entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="gallery")
 */
class Gallery
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $title;

    /**
     * @ORM\Column(type=text, nullable=true)
     */
    protected $description;
}
