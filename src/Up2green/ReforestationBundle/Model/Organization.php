<?php

namespace Up2green\ReforestationBundle\Model;

use Up2green\ReforestationBundle\Model\om\BaseOrganization;

/**
 * Organization entity
 */
class Organization extends BaseOrganization
{
    /**
     * @return string
     */
    public function __toString()
    {
        $string = "#".$this->getId();

        if ($title = $this->getTitle()) {
            $string .= " - " . $title;
        }

        return (string) $string;
    }
}
