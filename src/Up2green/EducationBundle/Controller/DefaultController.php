<?php

namespace Up2green\EducationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Up2green\EducationBundle\Model;

/**
 * Default controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="education_homepage")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $pictures = Model\ClassroomPictureQuery::create()->find();

        return array('pictures' => $pictures);
    }
}