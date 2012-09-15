<?php

namespace Up2green\ReforestationBundle\Controller;

use Up2green\ReforestationBundle\Model\Organization;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller
 */
class OrganizationController extends Controller
{
    /**
     * @Route("/organization/{id}", name="reforestation_organization_show")
     *
     * @Template(vars={"organization"})
     */
    public function showAction(Organization $organization)
    {
    }
}
