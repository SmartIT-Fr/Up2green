<?php

namespace Up2green\ReforestationBundle\Model;

use Up2green\ReforestationBundle\Model\om\BasePartner;

/**
 * Partner entity
 */
class Partner extends BasePartner
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
