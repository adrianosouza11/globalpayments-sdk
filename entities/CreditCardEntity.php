<?php

namespace GlobalPayments\entities;

use GlobalPayments\enum\PaymentMethodEnum;

/**
 * Class CreditCardEntity
 * @package common\components\services\globalpayment\entities
 */
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
     * @param $titular_name
     * @param $card_number
     * @param $expirate_date
     * @param $cvv2
     * @param $number_installments
     */
    public function __construct($titular_name, $card_number, $expirate_date, $cvv2, $number_installments)
    {
        parent::__construct($titular_name, $card_number, $expirate_date, $cvv2);
        $this->number_installments = $number_installments;
    }

    /**
     * @return string
     */
    public function getOperationType(){
        return $this->operation_type;
    }

    /**
     * @param int $number_installments
     */
    public function setNumberInstallments($number_installments){
        $this->number_installments = $number_installments;
    }

    /**
     * @return int
     */
    public function getNumberInstallments(){
        return $this->number_installments;
    }
}