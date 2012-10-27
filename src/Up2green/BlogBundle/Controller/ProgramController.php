<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\ProgramQuery;

use Up2green\ReforestationBundle\Model\Program;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter;

/**
 * Program controller
 */
class ProgramController extends Controller
{
    /**
     * Searches for the program with {id}
     *
     * @param Program $program
     *
     * @Route("/program/{id}", name="blog_program_show", requirements={"id"= "\d+"})
     * @Template(vars={"program"})
     * @return array
     */
    public function showAction(Program $program)
    {
        $program->setLocale($this->getRequest()->getLocale());

        return array('program' => $program);
    }

    /**
     * Displays list of all programs
     *
     * @Route("/program/", name="blog_program_list")
     * @Template()
     * @return array
     */
    public function listAction()
    {
        $pager = $this->getPager($this->getRequest()->get('page', 1), 10);

        return $pager;
    }

    /**
     * Displays list of programs in ajax
     *
     * @param integer $page
     *
     * @Route("/program/listAjax/{page}", name="blog_program_list_ajax", defaults={"page"= 1}, options={"expose"=true})
     * @Template()
     * @return array
     */
    public function listAjaxAction($page = 1)
    {
        $return = $this->getPager($page, $this->getRequest()->get('limit', 1));
        $return['options']['routeName'] = $this->getRequest()->get('routeName', '');
        $return['options']['routeParams'] = $this->getRequest()->get('routeParams', '');

        return $return;
    }

    /**
     * Gets list of all programs
     *
     * @param integer $page  The page
     * @param integer $limit The limit
     *
     * @return array
     */
    private function getPager($page, $limit)
    {
        $adapter = new PropelAdapter(ProgramQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale()));

        $pager = new Pagerfanta($adapter);
        $pager
            ->setMaxPerPage($limit)
            ->setCurrentPage($page);

        return array('pager' => $pager);
    }
}
