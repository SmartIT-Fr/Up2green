<?php

namespace Up2green\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friend class - Represent an invitation sent by a user to a friend
 * to create an account in up2green
 *
 * @ORM\Entity()
 * @ORM\Table(name="friend")
 */
class Friend
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\UserBundle\Entity\User", cascade={"remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\Column(unique = true)
     */
    protected $email;

    /**
     * @ORM\Column(name="is_newsletter", type="boolean")
     */
    protected $isNewsletter = true;
}
