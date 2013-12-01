<?php

namespace Up2green\SearchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Up2green\SearchBundle\Form\Type\SearchType;

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
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new SearchType());

        if ('POST' === $request->getMethod()) {
            $form->submit($request);
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
    public function searchAction(Request $request)
    {
        $form = $this->createForm(new SearchType());
        $form->submit($request);

        if (!$form->isValid()) {
            return $this->forward('Up2greenSearchBundle:Default:index');
        }

        $engine = $this->get('up2green_search.engine_factory')->createEngine(
            $form->get('q')->getData(),
            $form->get('type')->getData()
        );

        $results = $engine->getResults();

        return array(
            'form'    => $form->createView(),
            'results' => $results,
        );
    }
}
