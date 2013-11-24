<?php

namespace Up2green\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller of the BlogBundle
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_homepage")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * Displays programs in blog navigation menu
     *
     * @Template()
     * @return array
     * FIXME We should limit the request here
     */
    public function bannerAction()
    {
        $programs = $this->getDoctrine()
            ->getRepository('Up2greenReforestationBundle:Program')
            ->findAll();

        return array('programs' => $programs);
    }
}
