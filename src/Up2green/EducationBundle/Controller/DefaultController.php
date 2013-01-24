<?php

namespace Up2green\EducationBundle\Controller;

use Up2green\EducationBundle\Model\EducationVoucherQuery;
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
     * @Template()
     *
     * @return array
     */
    public function bannerAction()
    {
        $kits = EducationVoucherQuery::create()
            ->useVoucherQuery()
                ->filterByUsedBy(null, \Criteria::ISNOTNULL)
            ->endUse()
            ->count();

        $count = $kits*$this->container->getParameter('up2green_education.trees_by_kit');
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
        $pictures = Model\ClassroomPictureQuery::create()
            ->orderByCreatedAt(\Criteria::DESC)
            ->find();

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
