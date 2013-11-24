<?php

namespace Up2green\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="order")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"education_donation" = "Up2green\EducationBundle\Entity\Donation", "education_kit" = "Up2green\EducationBundle\Entity\OrderKit"})
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
     * @ORM\Column(type="decimal", length=10, scale=2)
     */
    protected $amount;

    /**
     * @ORM\OneToOne(targetEntity="JMS\Payment\CoreBundle\Entity\PaymentInstruction")
     * @ORM\JoinColumn(name="payment_instruction_id")
     */
    protected $paymentInstruction;
}
