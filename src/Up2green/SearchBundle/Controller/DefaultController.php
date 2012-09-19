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
        $request = $this->getRequest();

        if ($request->getMethod() === 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                return $this->forward('Up2greenSearchBundle:Default:search', $form->getData());
            }
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
        $form->bind($this->getRequest());

        if (!$form->isValid()) {
            return $this->redirect($this->generateUrl('search_homepage'));
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
