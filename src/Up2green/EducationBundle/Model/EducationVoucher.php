<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseEducationVoucher;

class EducationVoucher extends BaseEducationVoucher
{
    /**
     * @return string
     */
    public function __toString()
    {
        if (null === $this->getVoucher()){
            return '';
        }

        return $this->getVoucher()->__toString();
    }
}
