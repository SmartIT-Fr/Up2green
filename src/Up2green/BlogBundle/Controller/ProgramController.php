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
     * @Route("/program/{id}", name="blog_program_show")
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
        $adapter = new PropelAdapter(ProgramQuery::create()
            ->joinWithI18n($this->getRequest()->getLocale()));

        $pager = new Pagerfanta($adapter);
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array('pager' => $pager);
    }
}
