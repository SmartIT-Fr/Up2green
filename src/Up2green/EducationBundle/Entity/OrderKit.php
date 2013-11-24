<?php

namespace Up2green\EducationBundle\Entity;

use Up2green\CommonBundle\Entity\Order;

/**
 * Class OrderKit
 *
 * @ORM\Entity()
 * @ORM\Table(name="order_kit")
 */
class OrderKit extends Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="first_name")
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name")
     */
    protected $lastName;

    /**
     * @ORM\Column()
     */
    protected $email;

    /**
     * @ORM\Column(name="phone_number")
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(name="kits_number")
     */
    protected $kitsNumber;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\CommonBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
     */
    protected $address;
}
