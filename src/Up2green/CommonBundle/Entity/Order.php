<?php

namespace Up2green\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="order")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"education_donation" = "Donation", "education_kit" = "OrderKit"})
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", size="10", scale=2)
     */
    protected $amount;

    /**
     * @ORM\OneToOne(targetEntity="JMS\PaymentCoreBundle\Entity\PaymentInstruction")
     * @ORM\JoinColumn(name="payment_instruction_id")
     */
    protected $paymentInstruction;
}
