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
            $form->bindRequest($request);

            if ($form->isValid()) {

                die(var_dump($donation->getAmount()));
                $donation->save();

                return $this->redirect($this->generateUrl('up2green_education_donation_select_payment_method', array(
                    'id' => $donation->getId()
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}/select-payment-method", name="up2green_education_donation_select_payment_method")
     * @ParamConverter("donation", class="Up2green\EducationBundle\Model\Donation", options={"mapping"={"id":"id"}})
     * @Template
     */
    public function selectPaymentMethodAction(Request $request, Donation $donation)
    {
        $form = $this->createForm('jms_choose_payment_method', null, array(
            'amount'   => $donation->getAmount(),
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

                // FIXME Here we have to redirect to paypal ?

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
     * @ParamConverter("order", class="Up2green\CommonBundle\Model\Order", options={"mapping"={"id":"id"}})
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

        $this->get('session')->setFlash('success', "donation_success");

        return $this->redirect($this->generateUrl('up2green_education_donation_list'));
    }

    /**
     * @Route("/{id}/cancel", name="up2green_education_donation_cancel")
     * @ParamConverter("order", class="Up2green\CommonBundle\Model\Order", options={"mapping"={"id":"id"}})
     * @todo
     */
    public function cancelAction(Request $request, Order $order)
    {

    }

    /**
     * @Route("/list", name="up2green_education_donation_list")
     * @Template
     *
     * @todo Fetch only the 20 greatest donation with a valid order status and order them
     */
    public function listAction()
    {
        $donations = DonationQuery::create()->find();

        return array(
            'donations' => $donations
        );
    }
}