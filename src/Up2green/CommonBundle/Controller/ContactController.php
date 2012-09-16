<?php

namespace Up2green\CommonBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Up2green\CommonBundle\Form\Type\ContactType;

/**
 * Contact page controller
 */
class ContactController extends Controller
{

    /**
     * Contact form page
     *
     * @param Request $request
     *
     * @Route("/contact/", name="contact")
     * @Template()
     * @return array
     */
    public function defaultAction(Request $request)
    {
        $form = $this->createForm(new ContactType());

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $sender = $form->get('first_name')->getData().' '.$form->get('last_name')->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom(array($form->get('email')->getData() => $sender))
                    ->setTo('contact@up2green.com')
                    ->setBody($form->get('message')->getData());

                $this->get('mailer')->send($message);

                $this->get('session')->setFlash('success', "contact_email_sent");

                return $this->redirect($this->generateUrl('contact'));
            }
        }

        return array('form' => $form->createView());
    }
}