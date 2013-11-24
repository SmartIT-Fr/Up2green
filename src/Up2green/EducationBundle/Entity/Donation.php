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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected $email;

    /**
     * @ORM\Column(nullable=true)
     */
    protected $url;

    /**
     * @ORM\Column(name="is_anonymous", type="boolean")
     * @Assert\NotNull
     */
    protected $isAnonymous = false;

    /**
     * @ORM\Column(name="comment_public", nullable=true)
     */
    protected $commentPublic;

    /**
     * @ORM\Column(name="comment_private", nullable=true)
     */
    protected $commentPrivate;

    public function __construct()
    {
        $this->identifier = 'DONATION';
    }
}
