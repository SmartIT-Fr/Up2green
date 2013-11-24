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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column()
     */
    protected $name;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     * @ORM\Column(name="street_line_1", length=50)
     */
    protected $streetLine1;

    /**
     * @Assert\Length(max=50)
     * @ORM\Column(name="street_line_2", length=50, nullable=true)
     */
    protected $streetLine2;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     * @ORM\Column()
     */
    protected $zipcode;

    /**
     * @Assert\NotBlank
     * @ORM\Column()
     */
    protected $city;

    /**
     * @Assert\NotBlank
     * @ORM\Column()
     */
    protected $country;
}
