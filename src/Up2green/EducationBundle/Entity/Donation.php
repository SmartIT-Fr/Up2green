<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Up2green\CommonBundle\Entity\Order;

/**
 * Class Donation
 *
 * @ORM\Entity(repositoryClass="Up2green\EducationBundle\Repository\DonationRepository")
 * @ORM\Table(name="donation")
 */
class Donation extends Order
{
    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(nullable=true)
     */
    protected $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_anonymous", type="boolean")
     * @Assert\NotNull
     */
    protected $isAnonymous = false;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_public", nullable=true)
     */
    protected $commentPublic;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_private", nullable=true)
     */
    protected $commentPrivate;

    /**
     * @param string $commentPrivate
     */
    public function setCommentPrivate($commentPrivate)
    {
        $this->commentPrivate = $commentPrivate;
    }

    /**
     * @return string
     */
    public function getCommentPrivate()
    {
        return $this->commentPrivate;
    }

    /**
     * @param string $commentPublic
     */
    public function setCommentPublic($commentPublic)
    {
        $this->commentPublic = $commentPublic;
    }

    /**
     * @return string
     */
    public function getCommentPublic()
    {
        return $this->commentPublic;
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
     * @param boolean $isAnonymous
     */
    public function setIsAnonymous($isAnonymous)
    {
        $this->isAnonymous = $isAnonymous;
    }

    /**
     * @return boolean
     */
    public function getIsAnonymous()
    {
        return $this->isAnonymous;
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
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
