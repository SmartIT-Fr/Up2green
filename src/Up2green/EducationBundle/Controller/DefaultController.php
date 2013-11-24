<?php

namespace Up2green\EducationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller
 */
class DefaultController extends Controller
{
	/**
     * @Template()
     *
     * @return array
     */
    public function bannerAction()
    {
        $kits = $this->getDoctrine()
            ->getRepository('Up2rgeenEducationBundle:EducationVoucher')
            ->countUsed();

        $count = $kits * $this->container->getParameter('up2green_education.trees_by_kit');

        return array('count' => $count);
    }

    /**
     * @Route("/", name="education_homepage")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $pictures = $this->getDoctrine()->getRepository('Up2greenEducationBundle:ClassroomPicture')->findAll();

        return array('pictures' => $pictures);
    }

    /**
     * @Route("/the-project", name="education_the_project")
     * @Template()
     *
     * @return array
     */
    public function theProjectAction()
    {
        return array();
    }
}
