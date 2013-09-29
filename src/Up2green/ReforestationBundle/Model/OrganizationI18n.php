<?php

namespace Up2green\ReforestationBundle\Model;

use Up2green\ReforestationBundle\Model\om\BaseOrganizationI18n;

/**
 * OrganizationI18n entity
 */
class OrganizationI18n extends BaseOrganizationI18n
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
