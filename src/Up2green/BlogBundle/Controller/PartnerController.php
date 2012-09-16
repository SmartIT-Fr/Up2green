<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Partner controller
 */
class PartnerController extends Controller
{
    /**
     * Searches for the partner with {id}
     *
     * @param Partner $partner
     *
     * @Route("/partner/{id}", name="reforestation_partner_show")
     * @Template(vars={"partner"})
     */
    public function showAction(Partner $partner)
    {
    }
}
