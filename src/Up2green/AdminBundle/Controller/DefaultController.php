<?php

namespace Up2green\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Up2green\EducationBundle\Model;

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
    public function indexAction()
    {
        return array();
    }
}