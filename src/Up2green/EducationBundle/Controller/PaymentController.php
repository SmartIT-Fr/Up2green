<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/payments")
 */
class PaymentController extends Controller
{
    /**
     * @Route("/{orderNumber}/details", name = "payment_details")
     * @Template
     */
    public function detailsAction(Request $request, Donation $donation)
    {
        $form = $this->createForm('jms_choose_payment_method', null, array(
            'amount'   => $donation->getAmount(),
            'currency' => 'EUR',
            'default_method' => 'payment_paypal', // Optional
            'predefined_data' => array(
                'paypal_express_checkout' => array(
                    'return_url' => $this->generateUrl('payment_complete', array(
                        'orderNumber' => $donation->getOrderNumber(),
                    ), true),
                    'cancel_url' => $this->generateUrl('payment_cancel', array(
                        'orderNumber' => $donation->getOrderNumber(),
                    ), true)
                ),
            ),
        ));

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $instruction = $form->getData();
                $this->get('payment.plugin_controller')
                    ->createPaymentInstruction($instruction);

                $donation->setPaymentInstruction($instruction);
                $donation->save();

                return $this->redirect($this->generateUrl('payment_complete', array(
                    'orderNumber' => $donation->getOrderNumber(),
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }
}