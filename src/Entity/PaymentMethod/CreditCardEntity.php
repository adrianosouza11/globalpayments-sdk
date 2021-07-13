<?php

namespace GlobalPayments\Entity\PaymentMethod;

use GlobalPayments\Enum\PaymentMethodEnum;

class CreditCardEntity extends CardEntity
{
    /**
     * @var $operation_type
     */
    private $operation_type = PaymentMethodEnum::CREDIT_CARD;

    /**
     * @var int $number_installments
     */
    private $number_installments;

    /**
     * CreditCardEntity constructor.
     * @param string $titular_name
     * @param string $card_number
     * @param string $expiry_date
     * @param string $cvv2
     * @param int $number_installments
     */
    public function __construct(string $titular_name,string $card_number,string $expiry_date,string $cvv2 = null, int $number_installments)
    {
        parent::__construct($titular_name, $card_number, $expiry_date, $cvv2);
        $this->number_installments = $number_installments;
    }

    /**
     * @return string
     */
    public function getOperationType() : string
    {
        return $this->operation_type;
    }

    /**
     * @param int $number_installments
     */
    public function setNumberInstallments(int $number_installments) : void
    {
        $this->number_installments = $number_installments;
    }

    /**
     * @return int
     */
    public function getNumberInstallments() : int
    {
        return $this->number_installments;
    }
}