<?php

namespace Up2green\EducationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
    public function teacherAction()
    {
        $form = $this->createForm('education_voucher');

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