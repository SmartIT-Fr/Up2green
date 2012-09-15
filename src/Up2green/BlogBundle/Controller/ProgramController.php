<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\Program;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller
 */
class ProgramController extends Controller
{
    /**
     * @Route("/program/{id}", name="reforestation_program_show")
     *
     * @Template(vars={"program"})
     */
    public function showAction(Program $program)
    {
    }
}
