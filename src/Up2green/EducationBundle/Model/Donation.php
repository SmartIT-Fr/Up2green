<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseDonation;

class Donation extends BaseDonation
{
    public function __construct()
    {
        $this->identifier = 'DONATION';
    }
}
