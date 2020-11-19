<?php

namespace GlobalPayments\entities;

use GlobalPayments\enum\CurrencyEnum;
use GlobalPayments\enum\TransactionTypeEnum;
use GlobalPayments\util\Utilities;

class CardBankingEntity
{
    /**
     * @var int
     */
    protected $amount = 0;

    /**
     * @var string
     */
    protected $order_code = '';

    /**
     * @var int $paymentPlan;
     */
    protected $paymentPlan;

    /**
     * @var int $transactionType
     */
    protected $transactionType;

    /**
     * @var int $currency;
     */
    protected $currency;

    /**
     * @var CardEntity $cardEntity
     */
    protected $cardEntity;

    /**
     * CardBankingEntity constructor.
     * @param int $amount
     * @param string $order_code
     * @param CardEntity $cardEntity
     * @param int $paymentPlan
     * @param int $currency
     */
    public function __construct($amount, $order_code,CardEntity $cardEntity,$paymentPlan, $currency = CurrencyEnum::CURRENCY_BRAZIL)
    {
        $this->order_code = $order_code;
        $this->cardEntity = $cardEntity;
        $this->paymentPlan = $paymentPlan;
        $this->transactionType = TransactionTypeEnum::AUTHORIZATION;
        $this->currency = $currency;
        $this->setAmountFormatCurrency($amount);
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmountFormatCurrency($amount)
    {
        if ($this->currency == CurrencyEnum::CURRENCY_BRAZIL)
            $this->amount = Utilities::formatRealCurrencyValue($amount);
        else
            $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getOrderCode()
    {
        return $this->order_code;
    }

    /**
     * @param string $order_code
     */
    public function setOrderCode($order_code)
    {
        $this->order_code = $order_code;
    }

    /**
     * @return CardEntity
     */
    public function getCardEntity()
    {
        return $this->cardEntity;
    }

    /**
     * @param CardEntity $cardEntity
     */
    public function setCardEntity($cardEntity)
    {
        $this->cardEntity = $cardEntity;
    }

    /**
     * @return int
     */
    public function getPaymentPlan()
    {
        return $this->paymentPlan;
    }

    /**
     * @param int $paymentPlan
     */
    public function setPaymentPlan($paymentPlan)
    {
        $this->paymentPlan = $paymentPlan;
    }

    /**
     * @return int
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * @param int $transactionType
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}