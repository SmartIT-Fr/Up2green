<?php

namespace Up2green\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address
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
     * @Assert\NotBlank
     * @ORM\Column()
     */
    protected $name;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     * @ORM\Column(name="street_line_1", length=50)
     */
    protected $streetLine1;

    /**
     * @var string
     *
     * @Assert\Length(max=50)
     * @ORM\Column(name="street_line_2", length=50, nullable=true)
     */
    protected $streetLine2;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     * @ORM\Column()
     */
    protected $zipcode;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column()
     */
    protected $city;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column()
     */
    protected $country;

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $streetLine1
     */
    public function setStreetLine1($streetLine1)
    {
        $this->streetLine1 = $streetLine1;
    }

    /**
     * @return string
     */
    public function getStreetLine1()
    {
        return $this->streetLine1;
    }

    /**
     * @param string $streetLine2
     */
    public function setStreetLine2($streetLine2)
    {
        $this->streetLine2 = $streetLine2;
    }

    /**
     * @return string
     */
    public function getStreetLine2()
    {
        return $this->streetLine2;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }
}
