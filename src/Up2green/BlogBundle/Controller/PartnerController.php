<?php

namespace Up2green\BlogBundle\Controller;

use Up2green\ReforestationBundle\Model\PartnerQuery;
use Up2green\ReforestationBundle\Model\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\PropelAdapter;

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
     * @Route("/partner/{id}", name="blog_partner_show")
     * @Template(vars={"partner"})
     */
    public function showAction(Partner $partner)
    {
    }

    /**
     * Displays list of all partners
     *
     * @Route("/partner/", name="blog_partner_list")
     * @Template()
     * @return array
     */
    public function listAction()
    {
        $adapter = new PropelAdapter(PartnerQuery::create());

        $pager = new Pagerfanta($adapter);
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array('pager' => $pager);
    }
}
