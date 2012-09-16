<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\Program;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/program/{id}", name="reforestation_program_show")
     * @Template(vars={"program"})
     * @return array
     */
    public function showAction(Program $program)
    {
        $program->setLocale($this->getRequest()->getLocale());

        return array('program' => $program);
    }
}
