<?php

namespace Up2green\EducationBundle\Controller;

use Pagerfanta\Pagerfanta;

use Up2green\EducationBundle\Model\ClassroomQuery;

use Pagerfanta\Adapter\PropelAdapter;

use Up2green\EducationBundle\Form\Type\SearchClassroomType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Search classroom controller
 */
class SearchClassroomController extends Controller
{
	/**
     * Search page
     *
     * @param Request $request
     *
     * @Route("/search_classroom/", name="education_search_classroom")
     * @Template()
     * @return array
     */
    public function defaultAction(Request $request)
    {
        $form = $this->createForm(new SearchClassroomType());

        $query = ClassroomQuery::create();

        if ($request->getMethod() == 'GET') {
            $form->bind($request);

            if ($form->isValid()) {

                $city         = $form->get('school')->get('address')->getData();
                $schoolname   = $form->get('school')->get('name')->getData();
                $classname    = $form->get('name')->getData();
                $year         = $form->get('year')->getData();

                $query = $query
                    ->filterByName('%'.$classname.'%')
                    ->filterByYear('%'.$year.'%')
                    ->useSchoolQuery()
                        ->filterByName('%'.$schoolname.'%')
                        ->filterByAddress('%'.$city.'%')
                    ->endUse();
            }
        }

        $adapter = new PropelAdapter($query);

        $pager = new Pagerfanta($adapter);
        $pager
            ->setMaxPerPage(12)
            ->setCurrentPage($this->getRequest()->get('page', 1));

        return array('form' => $form->createView(), 'pager' => $pager);
    }
}
