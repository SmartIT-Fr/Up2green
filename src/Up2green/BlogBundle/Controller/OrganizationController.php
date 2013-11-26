<?php

namespace Up2green\BlogBundle\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

use Up2green\ReforestationBundle\Entity\Organization;

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
     * @Route("/organization/{id}", name="blog_organization_show")
     * @Template(vars={"organization"})
     * @return array
     */
    public function showAction(Organization $organization)
    {
    }

    /**
     * Displays list of all organizations
     *
     * @Route("/organization/", name="blog_organization_list")
     * @Template()
     * @return array
     */
    public function listAction()
    {
        $query = $this->getDoctrine()->getRepository('Up2greenReforestationBundle:Organization')->createQueryBuilder();
        $adapter = new DoctrineORMAdapter($query);

        $pager = new Pagerfanta($adapter);
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array('pager' => $pager);
    }
}
