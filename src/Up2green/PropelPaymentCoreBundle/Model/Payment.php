<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use JMS\Payment\CoreBundle\Model\PaymentInterface;
use Up2green\PropelPaymentCoreBundle\Model\om\BasePayment;

class Payment extends BasePayment implements PaymentInterface
{
    /**
     * @return FinancialTransactionInterface
     */
    public function getApproveTransaction()
    {
        foreach ($this->transactions as $transaction) {
            $type = $transaction->getTransactionType();

            if (FinancialTransactionInterface::TRANSACTION_TYPE_APPROVE === $type
                || FinancialTransactionInterface::TRANSACTION_TYPE_APPROVE_AND_DEPOSIT === $type) {

                return $transaction;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getDepositTransactions()
    {
        return $this->transactions->filter(function($transaction) {
           return FinancialTransactionInterface::TRANSACTION_TYPE_DEPOSIT === $transaction->getTransactionType();
        });
    }

    /**
     * @return FinancialTransactionInterface
     */
    public function getPendingTransaction()
    {
        foreach ($this->transactions as $transaction) {
            if (FinancialTransactionInterface::STATE_PENDING === $transaction->getState()) {
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

    /**
     * @return array
     */
    public function getReverseApprovalTransactions()
    {
        return $this->transactions->filter(function($transaction) {
           return FinancialTransactionInterface::TRANSACTION_TYPE_REVERSE_APPROVAL === $transaction->getTransactionType();
        });
    }

    /**
     * @return array
     */
    public function getReverseDepositTransactions()
    {
        return $this->transactions->filter(function($transaction) {
           return FinancialTransactionInterface::TRANSACTION_TYPE_REVERSE_DEPOSIT === $transaction->getTransactionType();
        });
    }

    /**
     * @return boolean
     */
    public function isAttentionRequired()
    {
        return $this->getAttentionRequired();
    }

    /**
     * @return boolean
     */
    public function isExpired()
    {
        return $this->getExpired();
    }

}
