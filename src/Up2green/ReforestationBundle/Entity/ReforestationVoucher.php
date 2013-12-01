<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Up2green\CommonBundle\Entity\Voucher;
use Up2green\CommonBundle\Entity\VoucherCategory;

/**
 * Class ReforestationVoucher
 *
 * @ORM\Entity()
 * @ORM\Table(name="reforestation_voucher")
 */
class ReforestationVoucher extends Voucher
{
    /**
     * @var VoucherCategory
     *
     * @ORM\ManyToOne(targetEntity="Up2green\CommonBundle\Entity\VoucherCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Up2green\ReforestationBundle\Entity\Tree")
     * @ORM\JoinTable(name="voucher_tree",
     *      joinColumns={@ORM\JoinColumn(name="voucher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tree_id", referencedColumnName="id")}
     * )
     */
    protected $trees;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trees = new ArrayCollection();
    }


    /**
     * @param VoucherCategory $category
     */
    public function setCategory(VoucherCategory $category)
    {
        $this->category = $category;
    }

    /**
     * @return VoucherCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ArrayCollection $trees
     */
    public function setTrees($trees)
    {
        $this->trees = $trees;
    }

    /**
     * @return ArrayCollection
     */
    public function getTrees()
    {
        return $this->trees;
    }
}
