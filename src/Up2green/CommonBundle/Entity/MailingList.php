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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="email_address", unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="is_newsletter", type="boolean")
     */
    protected $isNewsletter = true;
}
