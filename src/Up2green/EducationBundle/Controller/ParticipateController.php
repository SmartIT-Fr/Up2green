<?php

namespace Up2green\EducationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Up2green\EducationBundle\Entity\EducationVoucher;
use Up2green\EducationBundle\Entity\OrderKit;
use Up2green\CommonBundle\Entity\Order;

/**
 * Participate controller
 */
class ParticipateController extends Controller
{
    /**
     * @Route("/participate/teacher", name="education_participate_teacher")
     * @Template()
     *
     * @return array
     */
    public function teacherAction(Request $request)
    {
        $voucher = new EducationVoucher();
        $form = $this->createForm('education_voucher', $voucher, array(
            'validation_groups' => array('use')
        ));

        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {
                return $this->redirect($this->generateUrl('education.registration.new', array(
                	'token' => $form->get('code')->getData()
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/participate/donation", name="education_participate_donation")
     * @Template()
     *
     * @return array
     */
    public function donationAction()
    {
        return array();
    }
}
