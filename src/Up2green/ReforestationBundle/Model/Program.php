<?php

namespace Up2green\ReforestationBundle\Model;

use Up2green\ReforestationBundle\Model\om\BaseProgram;

/**
 * Program entity
 */
class Program extends BaseProgram
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }
}
