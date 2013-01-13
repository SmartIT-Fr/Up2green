<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JMS\Payment\CoreBundle\PluginController\Result;
use JMS\Payment\CoreBundle\Plugin\Exception\ActionRequiredException;
use JMS\Payment\CoreBundle\Plugin\Exception\Action\VisitUrl;
use JMS\Payment\CoreBundle\Model\FinancialTransactionInterface;
use JMS\Payment\CoreBundle\Model\PaymentInterface;
use JMS\Payment\CoreBundle\Model\PaymentInstructionInterface;

use Up2green\CommonBundle\Model\Order;

/**
 * @Route("/order")
 */
class OrderController extends Controller
{
    /**
     * @Route("/{id}/complete", name="up2green_education_order_complete")
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
        } elseif (Result::STATUS_SUCCESS !== $result->getStatus()) {
            throw new \RuntimeException('Transaction was not successful: '.$result->getReasonCode());
        }

        return $this->redirect($request->get('redirect_url', $this->generateUrl('education_homepage')));
    }

    /**
     * @Route("/{id}/cancel", name="up2green_education_order_cancel")
     */
    public function cancelAction(Request $request, Order $order)
    {
        $instruction = $order->getPaymentInstruction();

        $instruction->setState(PaymentInstructionInterface::STATE_CLOSED);
        $instruction->save();

        $transaction = $instruction->getPendingTransaction();

        if (null !== $transaction) {
            $transaction->setState(FinancialTransactionInterface::STATE_CANCELED);
            $transaction->getPayment()->setState(PaymentInterface::STATE_CANCELED);
        }

        return $this->redirect($request->get('redirect_url', $this->generateUrl('education_homepage')));
    }
}