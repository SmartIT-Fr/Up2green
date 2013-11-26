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
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Program
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=false)
     */
    protected $program;

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
     * @param Program $program
     */
    public function setProgram(Program $program)
    {
        $this->program = $program;
    }

    /**
     * @return Program
     */
    public function getProgram()
    {
        return $this->program;
    }
}
