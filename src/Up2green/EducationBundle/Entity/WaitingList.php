<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Up2green\CommonBundle\Entity\Address;

/**
 * WaitingList entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="waiting_list")
 */
class WaitingList
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
     * @var string
     *
     * @ORM\Column(name="first_name")
     * @Assert\NotBlank
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name")
     * @Assert\NotBlank
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column()
     * @Assert\NotBlank
     * @Assert\Email(checkMX=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number")
     * @Assert\NotBlank
     */
    protected $phoneNumber;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="kits_number")
     * @Assert\NotBlank
     */
    protected $kitsNumber;

    /**
     * @var Address
     *
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

    /**
     * @param \Up2green\CommonBundle\Entity\Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return \Up2green\CommonBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $kitsNumber
     */
    public function setKitsNumber($kitsNumber)
    {
        $this->kitsNumber = $kitsNumber;
    }

    /**
     * @return int
     */
    public function getKitsNumber()
    {
        return $this->kitsNumber;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
}