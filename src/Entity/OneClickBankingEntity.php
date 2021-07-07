<?php

namespace GlobalPayments\Entity;

use GlobalPayments\enum\CurrencyEnum;
use GlobalPayments\enum\TransactionTypeEnum;
use GlobalPayments\util\Utilities;

class OneClickBankingEntity
{
    /**
     * @var int $amount
     */
    protected $amount;

    /**
     * @var string $order_code
     */
    protected $order_code;

    /**
     * @var int $payment_plan
     */
    protected $payment_plan;

    /**
     * @var int $transaction_type
     */
    protected $transaction_type;

    /**
     * @var int $currency
     */
    protected $currency;

    /**
     * @var CardOneClickEntity $cardOneClick
     */
    protected $cardOneClick;

    /**
     * OneClickBankingEntity constructor.
     * @param int $amount
     * @param string $order_code
     * @param int $payment_plan
     * @param int $transaction_type
     * @param int $currency
     * @param CardOneClickEntity $cardOneClick
     */
    public function __construct($amount, $order_code, $payment_plan,CardOneClickEntity $cardOneClick,$currency = CurrencyEnum::CURRENCY_BRAZIL)
    {
        $this->order_code = $order_code;
        $this->payment_plan = $payment_plan;
        $this->transaction_type = TransactionTypeEnum::AUTHORIZATION;
        $this->currency = $currency;
        $this->cardOneClick = $cardOneClick;

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
     * @return int
     */
    public function getPaymentPlan()
    {
        return $this->payment_plan;
    }

    /**
     * @param int $payment_plan
     */
    public function setPaymentPlan($payment_plan)
    {
        $this->payment_plan = $payment_plan;
    }

    /**
     * @return int
     */
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param int $transaction_type
     */
    public function setTransactionType($transaction_type)
    {
        $this->transaction_type = $transaction_type;
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

    /**
     * @return CardOneClickEntity
     */
    public function getCardOneClick()
    {
        return $this->cardOneClick;
    }
}