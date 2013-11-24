<?php

namespace Up2green\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Up2green\ReforestationBundle\Entity\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

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
    public function listAction(Request $request)
    {
        $query = $this->getDoctrine()->getRepository('Up2greenReforestationBundle:Partner')->createQueryBuilder();
        $adapter = new DoctrineORMAdapter($query);

        $pager = new Pagerfanta($adapter);
        $pager->setCurrentPage($request->get('page', 1));

        return array('pager' => $pager);
    }

    /**
     * Displays list of partners in ajax
     *
     * @param integer $page
     *
     * @Route("/partner/listAjax/{page}", name="blog_partner_list_ajax", defaults={"page"= 1}, options={"expose"=true})
     * @Template()
     * @return array
     */
    public function listAjaxAction(Request $request, $page = 1)
    {
        $query = $this->getDoctrine()->getRepository('Up2greenReforestationBundle:Partner')->createQueryBuilder();
        $adapter = new DoctrineORMAdapter($query);

        $pager = new Pagerfanta($adapter);
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
            'pager' => $pager,
            'options' => array(
                'routeName' => $request->get('routeName', ''),
                'routeParams' => $request->get('routeParams', ''),
            )
        );
    }
}
