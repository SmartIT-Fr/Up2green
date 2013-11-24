<?php

namespace Up2green\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picture entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="picture")
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\BlogBundle\Entity\Gallery", cascade={"remove"})
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", nullable=false)
     */
    protected $gallery;

    /**
     * @ORM\Column
     */
    protected $src;
}
