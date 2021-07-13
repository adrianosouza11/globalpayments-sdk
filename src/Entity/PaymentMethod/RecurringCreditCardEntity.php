<?php

namespace GlobalPayments\Entity\PaymentMethod;

class RecurringCreditCardEntity extends CreditCardEntity
{
    /**
     * CreditCardEntity constructor.
     * @param string $titular_name
     * @param string $card_number
     * @param string $expiry_date
     * @param int $number_installments
     */
    public function __construct(string $titular_name,string $card_number,string $expiry_date,int $number_installments)
    {
        parent::__construct($titular_name, $card_number, $expiry_date, null,$number_installments);
    }
}