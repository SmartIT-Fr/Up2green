<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JMS\Payment\CoreBundle\PluginController\Result;
use Up2green\CommonBundle\Model\Order;
use Up2green\EducationBundle\Model\Donation;

/**
 * @Route("/donation")
 */
class DonationController extends Controller
{
    /**
     * @Route("/new", name="up2green_donation_new")
     */
    public function newAction(Request $request)
    {
        $donation = new Donation();

        $donation->setIdentifier('TEST3');
        $donation->setAmount(42.10);

        return $this->forward('Up2greenEducationBundle:Donation:show', array(
            'donation' => $donation
        ));
    }

    /**
     * @Route("/{identifier}/show", name="up2green_education_donation_show")
     * @ParamConverter("donation", class="Up2green\EducationBundle\Model\Donation", options={"mapping"={"identifier":"identifier"}})
     * @Template
     */
    public function showAction(Request $request, Donation $donation)
    {
        $form = $this->createForm('jms_choose_payment_method', null, array(
            'amount'   => $donation->getAmount(),
            'currency' => 'EUR',
            'default_method' => 'payment_paypal', // Optional
            'predefined_data' => array(
                'paypal_express_checkout' => array(
                    'return_url' => $this->generateUrl('up2green_education_donation_complete', array(
                        'identifier' => $donation->getIdentifier(),
                    ), true),
                    'cancel_url' => $this->generateUrl('up2green_education_donation_cancel', array(
                        'identifier' => $donation->getIdentifier(),
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

                return $this->redirect($this->generateUrl('up2green_education_donation_complete', array(
                    'identifier' => $donation->getIdentifier(),
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{identifier}/complete", name="up2green_education_donation_complete")
     * @ParamConverter("order", class="Up2green\CommonBundle\Model\Order", options={"mapping"={"identifier":"identifier"}})
     */
    public function completeAction(Request $request, Order $order)
    {
        $ppc = $this->get('payment.plugin_controller');

        $instruction = $order->getPaymentInstruction();
        if (null === $pendingTransaction = $instruction->getPendingTransaction()) {
            $payment = $ppc->createPayment($instruction->getId(), $instruction->getAmount() - $instruction->getDepositedAmount());
        } else {
            $payment = $pendingTransaction->getPayment();
        }

        $result = $ppc->approveAndDeposit($payment->getId(), $payment->getTargetAmount());
        if (Result::STATUS_PENDING === $result->getStatus()) {
            $ex = $result->getPluginException();

            if ($ex instanceof ActionRequiredException) {
                $action = $ex->getAction();

                if ($action instanceof VisitUrl) {
                    return $this->redirect($action->getUrl());
                }

                throw $ex;
            }
        } else if (Result::STATUS_SUCCESS !== $result->getStatus()) {
            throw new \RuntimeException('Transaction was not successful: '.$result->getReasonCode());
        }

        // payment was successful, do something interesting with the order
    }

    /**
     * @Route("/{identifier}/cancel", name="up2green_education_donation_cancel")
     * @ParamConverter("order", class="Up2green\CommonBundle\Model\Order", options={"mapping"={"identifier":"identifier"}})
     *
     */
    public function cancelAction(Request $request, Order $order)
    {

    }
}