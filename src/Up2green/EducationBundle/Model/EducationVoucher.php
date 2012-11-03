<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseEducationVoucher;

class EducationVoucher extends BaseEducationVoucher
{
    public function __toString()
    {
        return $this->getVoucher()->__toString();
    }
}
