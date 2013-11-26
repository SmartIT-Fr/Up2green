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
     * @ORM\Column(name="first_name", nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(unique=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(length=128, unique=true)
     */
    protected $username;

    /**
     * @var boolean
     *
     * @ORM\Column(name="accept_newsletter", type="boolean")
     */
    protected $acceptNewsletter = true;

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
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
