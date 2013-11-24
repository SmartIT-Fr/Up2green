<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Up2green\CommonBundle\Entity\Voucher;

/**
 * Class ReforestationVoucher
 *
 * @ORM\Entity()
 * @ORM\Table(name="reforestation_voucher")
 */
class ReforestationVoucher extends Voucher
{
    /**
     * @ORM\ManyToOne(targetEntity="Up2green\CommonBundle\Entity\VoucherCategory")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

    /**
     * @ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Tree")
     * @JoinTable(name="voucher_tree",
     *      joinColumns={@JoinColumn(name="voucher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tree_id", referencedColumnName="id")}
     * )
     */
    protected $trees;
}
