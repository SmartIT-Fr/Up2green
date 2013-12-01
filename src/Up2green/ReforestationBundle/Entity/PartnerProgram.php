<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PartnerProgram entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="partner_program")
 */
class PartnerProgram
{
    /**
     * @var Partner
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Partner", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $partner;

    /**
     * @var Program
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $program;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $number = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $hardcode = 0;

    /**
     * @param integer $hardcode
     */
    public function setHardcode($hardcode)
    {
        $this->hardcode = $hardcode;
    }

    /**
     * @return integer
     */
    public function getHardcode()
    {
        return $this->hardcode;
    }

    /**
     * @param integer $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param Partner $partner
     */
    public function setPartner(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return Partner
     */
    public function getPartner()
    {
        return $this->partner;
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
