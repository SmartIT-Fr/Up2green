<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use JMS\Payment\CoreBundle\Model\PaymentInstructionInterface;
use Up2green\PropelPaymentCoreBundle\Model\om\BasePaymentInstruction;

class PaymentInstruction extends BasePaymentInstruction implements PaymentInstructionInterface
{
    /**
     * @return Up2green\PropelPaymentCoreBundle\Model\FinancialTransaction
     */
    public function getPendingTransaction()
    {
        foreach ($this->payments as $payment) {
            if (null !== $transaction = $payment->getPendingTransaction()) {
                return $transaction;
            }
        }

        foreach ($this->credits as $credit) {
            if (null !== $transaction = $credit->getPendingTransaction()) {
                return $transaction;
            }
        }

        return null;
    }

    /**
     * @return boolean
     */
    public function hasPendingTransaction()
    {
        return null !== $this->getPendingTransaction();
    }
}
