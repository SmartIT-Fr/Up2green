<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\Organization;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Organization controller
 */
class OrganizationController extends Controller
{
    /**
     * Searches for the organization with {id}
     *
     * @param Organization $organization
     *
     * @Route("/organization/{id}", name="reforestation_organization_show")
     * @Template(vars={"organization"})
     * @return array
     */
    public function showAction(Organization $organization)
    {
        $organization->setLocale($this->getRequest()->getLocale());

        return array('organization' => $organization);
    }
}
