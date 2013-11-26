<?php

namespace Up2green\EducationBundle\Entity;

use Up2green\CommonBundle\Entity\Address;
use Up2green\CommonBundle\Entity\Order;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrderKit
 *
 * @ORM\Entity()
 * @ORM\Table(name="order_kit")
 */
class OrderKit extends Order
{
    /**
     * @var string
     *
     * @ORM\Column(name="first_name")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name")
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column()
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number")
     */
    protected $phoneNumber;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="kits_number")
     */
    protected $kitsNumber;

    /**
     * @var Address
     *
     * @ORM\ManyToOne(targetEntity="Up2green\CommonBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
     */
    protected $address;

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
     * @param integer $kitsNumber
     */
    public function setKitsNumber($kitsNumber)
    {
        $this->kitsNumber = $kitsNumber;
    }

    /**
     * @return integer
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
