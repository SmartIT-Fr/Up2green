<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use JMS\Payment\CoreBundle\Model\CreditInterface;
use Up2green\PropelPaymentCoreBundle\Model\om\BaseCredit;

/**
 * Credit entity
 */
class Credit extends BaseCredit implements CreditInterface
{
    /**
     * @return FinancialTransactionInterface
     */    
    public function getCreditTransaction()
    {
        foreach ($this->transactions as $transaction) {
            if (FinancialTransactionInterface::TRANSACTION_TYPE_CREDIT === $transaction->getTransactionType()) {
                return $transaction;
            }
        }

        return null;
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
     * @return array
     */
    public function getReverseCreditTransactions()
    {
        return $this->transactions->filter(function($transaction) {
            return FinancialTransactionInterface::TRANSACTION_TYPE_REVERSE_CREDIT === $transaction->getTransactionType();
        });
    }
    
    /**
     * @return boolean
     */
    public function hasPendingTransaction()
    {
        return null !== $this->getPendingTransaction();
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
    public function isIndependent()
    {
        return null === $this->payment;
    }
}
