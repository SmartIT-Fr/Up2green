<?php
namespace Up2green\EducationBundle\Tests\Model;

use Up2green\EducationBundle\Model\Classroom;

class ClassroomTest extends \PHPUnit_Framework_TestCase
{
    public function testNewSchoolYear()
    {
        $classroom = new Classroom();

        $this->assertEquals(date('Y'), $classroom->getYear());
    }
}