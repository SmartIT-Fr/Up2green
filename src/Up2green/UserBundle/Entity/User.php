<?php

namespace Up2green\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Tree")
     * @ORM\JoinTable(name="user_tree",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tree_id", referencedColumnName="id")}
     * )
     */
    protected $trees;

    /**
     * @ORM\Column(type="float")
     */
    protected $credit = 0;

    /**
     * @ORM\Column(name="accept_newsletter", type="boolean")
     */
    protected $acceptNewsletter = true;

    /**
     * @ORM\Column(length=7)
     */
    protected $locale = 'fr_FR';
}