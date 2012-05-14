<?php

namespace Up2green\SearchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Up2green\SearchBundle\Form\Type\SearchType;
use Up2green\SearchBundle\Services\Engine\EngineFactory;
/**
 * Default Controller class
 */
class DefaultController extends Controller
{
    /**
     * Index Action
     *
     * @Route("/", name="search_homepage")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $form = $this->createForm(new SearchType());
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->forward('Up2greenSearchBundle:Default:search', $form->getData());
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * Search Action
     *
     * @Route("/search", name="search_search")
     * @Template()
     *
     * @return array
     */
    public function searchAction()
    {
        $form = $this->createForm(new SearchType());
        $form->bindRequest($this->getRequest());

        if (!$form->isValid()) {
            return $this->redirect($this->generateUrl('search_homepage'));
        }

        // FIXME errors throwed in this controller are not throwed
        try {
            $results = $this->get('up2green_search.engine_factory')
                ->createEngine($form->get('q')->getData(), $form->get('type')->getData())
                ->getResults();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return array(
            'form'    => $form->createView(),
            'results' => $results,
        );
    }
}
