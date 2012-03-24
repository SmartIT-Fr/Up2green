<?php

namespace Up2green\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default Controller class 
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="search_homepage")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }
}
