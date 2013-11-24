<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Up2green\CommonBundle\Entity\Voucher;

/**
 * Class EducationVoucher
 *
 * @ORM\Entity(repositoryClass="Up2green\EducationBundle\Repository\EducationVoucherRepository")
 * @ORM\Table(name="education_voucher")
 */
class EducationVoucher extends Voucher
{
}
