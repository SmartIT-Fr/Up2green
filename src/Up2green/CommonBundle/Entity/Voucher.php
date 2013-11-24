<?php

namespace Up2green\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="Up2green\CommonBundle\Repository\VoucherRepository")
 * @ORM\Table(name="voucher")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"education_voucher" = "Up2green\EducationBundle\Entity\EducationVoucher", "reforestation_voucher" = "Up2green\ReforestationBundle\Entity\ReforestationVoucher"})
 *
 * @DoctrineAssert\UniqueEntity("code")
 *
 * FIXME PrePersist listener to set the code ?
 */
class Voucher
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="code", type="string", length=128, unique=true)
     * @Assert\NotBlank(groups={"use"})
     */
    protected $code;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\UserBundle\Entity\User", inversedBy="usedVouchers")
     * @ORM\JoinColumn(name="used_by", referencedColumnName="id", nullable=true)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\UserBundle\Entity\User", inversedBy="vouchers")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=true)
     */
    protected $owner;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @Assert\True(groups={"use"})
     */
    protected $isActive;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->code;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }
}
