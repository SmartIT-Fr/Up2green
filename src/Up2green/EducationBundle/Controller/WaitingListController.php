<?php

namespace Up2green\EducationBundle\Controller;

use Up2green\EducationBundle\Form\Type\WaitingListType;
use Up2green\EducationBundle\Entity\WaitingList;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * WaitingList controller
 */
class WaitingListController extends Controller
{

    /**
     * Join the waiting list form page
     *
     * @param Request $request
     *
     * @Route("/waitinglist/join", name="education_waitinglist_join")
     * @Template()
     * @return array
     */
    public function joinAction(Request $request)
    {
        $waitingList = new WaitingList();
        $form = $this->createForm(new WaitingListType(), $waitingList);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->persist($waitingList);
                $this->getDoctrine()->getManager()->flush();

                $this->get('session')->getFlashBag()->add('success', "waiting_list_joined");

                return $this->redirect($this->generateUrl('education_homepage'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }
}
