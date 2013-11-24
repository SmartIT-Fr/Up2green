<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * WaitingList entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="waiting_list")
 */
class WaitingList
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="first_name")
     * @Assert\NotBlank
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name")
     * @Assert\NotBlank
     */
    protected $lastName;

    /**
     * @ORM\Column()
     * @Assert\NotBlank
     * @Assert\Email(checkMX=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="phone_number")
     * @Assert\NotBlank
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(name="kits_number")
     * @Assert\NotBlank
     */
    protected $kitsNumber;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\CommonBundle\Entity\Address", cascade={"remove"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $address;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}