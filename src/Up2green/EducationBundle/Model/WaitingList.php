<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseWaitingList;

/**
 * WaitingList entity
 */
class WaitingList extends BaseWaitingList
{
    public function __toString()
    {
        return (string)$this->getId();
    }
}
