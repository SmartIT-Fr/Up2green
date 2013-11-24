<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tree entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="tree")
 */
class Tree
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=false)
     */
    protected $program;
}
