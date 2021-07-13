<?php

namespace GlobalPayments\Entity\Banking;

use GlobalPayments\Entity\PaymentMethod\CardOneClickEntity;
use GlobalPayments\Enum\CurrencyEnum;
use GlobalPayments\Enum\TransactionTypeEnum;
use GlobalPayments\Util\Utilities;

class OneClickBankingEntity
{
    /**
     * @var float $amount
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
     * @var string $transaction_type
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
     * @param float $amount
     * @param string $order_code
     * @param int $payment_plan
     * @param int $currency
     * @param CardOneClickEntity $cardOneClick
     */
    public function __construct(
        float $amount,
        string $order_code,
        int $payment_plan,
        CardOneClickEntity $cardOneClick,
        int $currency = CurrencyEnum::CURRENCY_BRAZIL
    )
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
    public function getAmount() : int
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmountFormatCurrency(float $amount) : void
    {
        if ($this->currency == CurrencyEnum::CURRENCY_BRAZIL)
            $this->amount = Utilities::formatRealCurrencyValue($amount);
        else
            $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getOrderCode() : string
    {
        return $this->order_code;
    }

    /**
     * @param string $order_code
     */
    public function setOrderCode(string $order_code) : void
    {
        $this->order_code = $order_code;
    }

    /**
     * @return int
     */
    public function getPaymentPlan() : int
    {
        return $this->payment_plan;
    }

    /**
     * @param int $payment_plan
     */
    public function setPaymentPlan(int $payment_plan) : void
    {
        $this->payment_plan = $payment_plan;
    }

    /**
     * @return string
     */
    public function getTransactionType() : string
    {
        return $this->transaction_type;
    }

    /**
     * @param string $transaction_type
     */
    public function setTransactionType(string $transaction_type) : void
    {
        $this->transaction_type = $transaction_type;
    }

    /**
     * @return int
     */
    public function getCurrency() : int
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency(int $currency) : void
    {
        $this->currency = $currency;
    }

    /**
     * @return CardOneClickEntity
     */
    public function getCardOneClick() : CardOneClickEntity
    {
        return $this->cardOneClick;
    }
}