<?php

namespace Up2green\EducationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;

use Up2green\EducationBundle\Model\EducationVoucher;
use Up2green\EducationBundle\Model\OrderKit;
use Up2green\CommonBundle\Model\Order;

/**
 * Participate controller
 *
 * @Route("/buy")
 */
class BuyController extends Controller
{
    /**
     * @Route("/new", name="up2green_education_buy_new")
     * @Template()
     *
     * @return array
     */
    public function newAction(Request $request)
    {
        $orderKit = new OrderKit();
        $form = $this->createForm('education_order_kit', $orderKit);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $amount = $form->get('kits_number')->getData() * $this->container->getParameter('up2green_education.kit_price');
                $commonOrder = new Order();
                $commonOrder->setAmount($amount);
                $commonOrder->save();

                // Form that generate payment instruction
                $paymentInstructionForm = $this->createForm('jms_choose_payment_method', null, array(
                    'csrf_protection' => false,
                    'amount'   => $amount,
                    'currency' => 'EUR',
                    'default_method' => 'payment_paypal',
                    'predefined_data' => array(
                        'paypal_express_checkout' => array(
                            'return_url' => $this->generateUrl('up2green_education_buy_complete', array(
                                'id' => $commonOrder->getId(),
                            ), true),
                            'cancel_url' => $this->generateUrl('up2green_education_buy_cancel', array(
                                'id' => $commonOrder->getId(),
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

                $commonOrder->setPaymentInstruction($instruction);
                $orderKit->setOrder($commonOrder);
                $orderKit->save();

                return $this->redirect($this->generateUrl('up2green_education_buy_complete', array(
                    'id' => $orderKit->getOrder()->getId(),
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}/complete", name="up2green_education_buy_complete")
     */
    public function completeAction(Order $order)
    {
        $this->get('session')->setFlash('success', "buy_success");

        return $this->forward(
            'Up2greenEducationBundle:Order:complete',
            array('order' => $order),
            array('redirect_url' => $this->generateUrl('education_homepage'))
        );
    }

    /**
     * @Route("/{id}/cancel", name="up2green_education_buy_cancel")
     */
    public function cancelAction(Order $order)
    {
        $this->get('session')->setFlash('warning', "buy_canceled");

        return $this->forward(
            'Up2greenEducationBundle:Order:cancel',
            array('order' => $order),
            array('redirect_url' => $this->generateUrl('education_homepage'))
        );
    }
}
