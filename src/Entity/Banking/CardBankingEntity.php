<?php

namespace GlobalPayments\Entity\Banking;

use GlobalPayments\Entity\PaymentMethod\CardEntity;
use GlobalPayments\Enum\CurrencyEnum;
use GlobalPayments\Enum\TransactionTypeEnum;
use GlobalPayments\Util\Utilities;

class CardBankingEntity
{
    /**
     * @var float
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
     * @var string $transactionType
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
     * @param float $amount
     * @param string $order_code
     * @param CardEntity $cardEntity
     * @param int $paymentPlan
     * @param int $currency
     */
    public function __construct(
        float $amount,
        string $order_code,
        CardEntity $cardEntity,
        int $paymentPlan,
        int $currency = CurrencyEnum::CURRENCY_BRAZIL
    )
    {
        $this->order_code = $order_code;
        $this->cardEntity = $cardEntity;
        $this->paymentPlan = $paymentPlan;
        $this->transactionType = TransactionTypeEnum::AUTHORIZATION;
        $this->currency = $currency;
        $this->setAmountFormatCurrency($amount);
    }

    /**
     * @return float
     */
    public function getAmount() : float
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
     * @return CardEntity
     */
    public function getCardEntity() : CardEntity
    {
        return $this->cardEntity;
    }

    /**
     * @return int
     */
    public function getPaymentPlan() : int
    {
        return $this->paymentPlan;
    }

    /**
     * @param int $paymentPlan
     */
    public function setPaymentPlan(int $paymentPlan) : void
    {
        $this->paymentPlan = $paymentPlan;
    }

    /**
     * @return int
     */
    public function getTransactionType() : string
    {
        return $this->transactionType;
    }

    /**
     * @param string $transactionType
     */
    public function setTransactionType(string $transactionType) : void
    {
        $this->transactionType = $transactionType;
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
}