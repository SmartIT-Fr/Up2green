<?php

namespace Up2green\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailingList entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="mailingList")
 */
class MailingList
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
     * @ORM\Column(name="email_address", unique=true)
     */
    protected $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_newsletter", type="boolean")
     */
    protected $isNewsletter = true;

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
     * @param boolean $isNewsletter
     */
    public function setIsNewsletter($isNewsletter)
    {
        $this->isNewsletter = $isNewsletter;
    }

    /**
     * @return boolean
     */
    public function getIsNewsletter()
    {
        return $this->isNewsletter;
    }
}
