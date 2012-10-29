<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Up2green\EducationBundle\Model;

/**
 * Classroom controller
 */
class ClassroomController extends Controller
{
    /**
     * @param Model\School $school
     * @param Model\Classroom $classroom
     *
     * @Route("/school/{school_slug}/{classroom_slug}", name="education_classroom_show")
     * @Template(vars={"school", "classroom"})
     * @ParamConverter("school", class="Up2green\EducationBundle\Model\School", options={"mapping"={"school_slug":"slug"}})
     * @ParamConverter("classroom", class="Up2green\EducationBundle\Model\Classroom", options={"mapping"={"classroom_slug":"slug"}})
     */
    public function showAction(Model\School $school, Model\Classroom $classroom)
    {
    }
}