<?php

namespace Up2green\EducationBundle\Model;

use Up2green\EducationBundle\Model\om\BaseClassroom;

class Classroom extends BaseClassroom
{
    /**
     * When a school is created, we set the year property to the actual year
     */
    public function __construct()
    {
        $this->year = date('Y');
    }
}
