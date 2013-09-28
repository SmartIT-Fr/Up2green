<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;

use Up2green\CommonBundle\Model\Order;
use Up2green\EducationBundle\Model\Donation;
use Up2green\EducationBundle\Model\DonationQuery;

/**
 * @Route("/donation")
 */
class DonationController extends Controller
{
    /**
     * @Route("/new", name="up2green_education_donation_new")
     * @Template
     */
    public function newAction(Request $request)
    {
        $donation = new Donation();

        $form = $this->createForm('education_donation', $donation);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {

                $donation->save();

                // Form that generate payment instruction
                $paymentInstructionForm = $this->createForm('jms_choose_payment_method', null, array(
                    'csrf_protection' => false,
                    'amount'   => $donation->getOrder()->getAmount(),
                    'currency' => 'EUR',
                    'default_method' => 'payment_paypal',
                    'predefined_data' => array(
                        'paypal_express_checkout' => array(
                            'return_url' => $this->generateUrl('up2green_education_donation_complete', array(
                                'id' => $donation->getOrder()->getId(),
                            ), true),
                            'cancel_url' => $this->generateUrl('up2green_education_donation_cancel', array(
                                'id' => $donation->getOrder()->getId(),
                            ), true)
                        ),
                    ))
                );

                $paymentInstructionForm->bind(array('method' => 'paypal_express_checkout'));

                if (!$paymentInstructionForm->isValid()) {
                    throw new HttpException(500, "The order shoul be valid at this point");
                }

                $instruction = $paymentInstructionForm->getData();
                $this->get('payment.plugin_controller')->createPaymentInstruction($instruction);

                $donation->setPaymentInstruction($instruction);
                $donation->save();

                return $this->redirect($this->generateUrl('up2green_education_donation_complete', array(
                    'id' => $donation->getOrder()->getId(),
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}/complete", name="up2green_education_donation_complete")
     */
    public function completeAction(Request $request, Order $order)
    {
        $this->get('session')->getFlashBag()->add('success', "donation_success");

        return $this->forward(
            'Up2greenEducationBundle:Order:complete',
            array('order' => $order),
            array('redirect_url' => $this->generateUrl('up2green_education_donation_list'))
        );
    }

    /**
     * @Route("/{id}/cancel", name="up2green_education_donation_cancel")
     */
    public function cancelAction(Order $order)
    {
        $this->get('session')->getFlashBag()->add('warning', "donation_canceled");

        return $this->forward(
            'Up2greenEducationBundle:Order:cancel',
            array('order' => $order),
            array('redirect_url' => $this->generateUrl('up2green_education_donation_list'))
        );
    }

    /**
     * @Route("/list", name="up2green_education_donation_list")
     * @Template
     */
    public function listAction()
    {
        return array(
            'donations' => DonationQuery::create()->findGreatestValid()
        );
    }
}
