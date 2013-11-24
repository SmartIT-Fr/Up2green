<?php

namespace Up2green\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="newsletter")
 */
class Newsletter
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column
     */
    protected $title;

    /**
     * @ORM\Column(type=text)
     */
    protected $content;

    /**
     * @ORM\Column
     */
    protected $sender = "Up2green";

    /**
     * @ORM\Column
     */
    protected $reply = "no-reply@up2green.com";

    /**
     * @ORM\Column(name="sent_at", type="datetime")
     */
    protected $sentAt;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isForced = false;
}
