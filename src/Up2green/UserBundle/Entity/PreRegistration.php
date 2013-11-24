<?php

namespace Up2green\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PreRegistration class - This class allow beta members to create an account
 * with already filled fields
 *
 * @ORM\Entity()
 * @ORM\Table(name="pre_registration")
 */
class PreRegistration
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="first_name", nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name", nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\Column(unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(length=128, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(name="accept_newsletter", type="boolean")
     */
    protected $acceptNewsletter = true;
}
