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
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Up2green\BlogBundle\Entity\Gallery", cascade={"remove"})
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", nullable=false)
     */
    protected $gallery;

    /**
     * @var string
     *
     * @ORM\Column
     */
    protected $src;

    /**
     * @param Gallery $gallery
     */
    public function setGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
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
     * @param string $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }
}
