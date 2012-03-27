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
     * @Route("/{_locale}", name="blog_homepage_localized")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
