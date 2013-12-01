<?php

namespace Up2green\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Up2green\ReforestationBundle\Entity\Tree")
     * @ORM\JoinTable(name="user_tree",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tree_id", referencedColumnName="id")}
     * )
     */
    protected $trees;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $credit = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accept_newsletter", type="boolean")
     */
    protected $acceptNewsletter = true;

    /**
     * @var string
     *
     * @ORM\Column(length=7)
     */
    protected $locale = 'fr';

    /**
     * @param boolean $acceptNewsletter
     */
    public function setAcceptNewsletter($acceptNewsletter)
    {
        $this->acceptNewsletter = $acceptNewsletter;
    }

    /**
     * @return boolean
     */
    public function getAcceptNewsletter()
    {
        return $this->acceptNewsletter;
    }

    /**
     * @param float $credit
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    }

    /**
     * @return float
     */
    public function getCredit()
    {
        return $this->credit;
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
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param ArrayCollection $trees
     */
    public function setTrees(ArrayCollection $trees)
    {
        $this->trees = $trees;
    }

    /**
     * @return ArrayCollection
     */
    public function getTrees()
    {
        return $this->trees;
    }
}