<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\ProgramQuery;

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
     */
    public function bannerAction()
    {
        $programs = ProgramQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale())
            ->find(); // one query to retrieve both all items and their translations

        return array('programs' => $programs);
    }
}
