<?php

namespace Up2green\ReforestationBundle\Entity;

/**
 * PartnerProgram entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="partner_program")
 */
class PartnerProgram
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Partner", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $partner;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $program;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number = 0;

    /**
     * @ORM\Column(type="integer")
     */
    protected $hardcode = 0;
}
