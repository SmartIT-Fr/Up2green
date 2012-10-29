<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use JMS\Payment\CoreBundle\Model\CreditInterface;
use JMS\Payment\CoreBundle\Model\PaymentInterface;

/**
 * FinancialTransaction interface
 */
interface FinancialTransactionInterface
{
    const STATE_CANCELED = 1;
    const STATE_FAILED = 2;
    const STATE_NEW = 3;
    const STATE_PENDING = 4;
    const STATE_SUCCESS = 5;

    const TRANSACTION_TYPE_APPROVE = 1;
    const TRANSACTION_TYPE_APPROVE_AND_DEPOSIT = 2;
    const TRANSACTION_TYPE_CREDIT = 3;
    const TRANSACTION_TYPE_DEPOSIT = 4;
    const TRANSACTION_TYPE_REVERSE_APPROVAL = 5;
    const TRANSACTION_TYPE_REVERSE_CREDIT = 6;
    const TRANSACTION_TYPE_REVERSE_DEPOSIT = 7;

    function getCredit();
    function getExtendedData();
    function getId();
    function getPayment();
    function getProcessedAmount();
    function getReasonCode();
    function getReferenceNumber();
    function getRequestedAmount();
    function getResponseCode();
    function getState();
    function getTrackingId();
    function getTransactionType();
    function setCredit(CreditInterface $credit);
    function setExtendedData(ExtendedDataInterface $data);
    function setPayment(PaymentInterface $payment);
    function setProcessedAmount($amount);
    function setReasonCode($code);
    function setReferenceNumber($referenceNumber);
    function setRequestedAmount($amount);
    function setResponseCode($code);
    function setState($state);
    function setTrackingId($id);
    function setTransactionType($type);
}