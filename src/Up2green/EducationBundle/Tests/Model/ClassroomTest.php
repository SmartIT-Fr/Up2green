<?php
namespace Up2green\EducationBundle\Tests\Model;

use Up2green\EducationBundle\Model\Classroom;

/**
 * Classroom tests
 */
class ClassroomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the default year of the classroom
     */
    public function testNewYear()
    {
        $classroom = new Classroom();

        $this->assertEquals(date('Y'), $classroom->getYear());
    }
}