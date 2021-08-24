<?php

namespace GlobalPayments\Entity\Banking;

use GlobalPayments\Enum\CurrencyEnum;
use GlobalPayments\Enum\TransactionTypeEnum;
use GlobalPayments\Util\Utilities;

class CancellationPayBankingEntity
{
    /** @var float */
    protected $amount = 0;

    /** @var string */
    protected $order_code = '';

    /** @var string $transactionType */
    protected $transactionType;

    /** @var int $currency; */
    protected $currency;

    /**
     * @param float $amount
     * @param string $order_code
     * @param int $currency
     */
    public function __construct(float $amount,string $order_code,int $currency = CurrencyEnum::CURRENCY_BRAZIL)
    {
        $this->order_code = $order_code;
        $this->transactionType = TransactionTypeEnum::CANCELLATION;
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
    public function getOrderCode(): string
    {
        return $this->order_code;
    }

    /**
     * @param string $order_code
     */
    public function setOrderCode(string $order_code): void
    {
        $this->order_code = $order_code;
    }

    /**
     * @return int
     */
    public function getCurrency(): int
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency(int $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getTransactionType(): string
    {
        return $this->transactionType;
    }
}