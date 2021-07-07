<?php


namespace GlobalPayments\Entity;

use GlobalPayments\Enum\PaymentMethodEnum;

class CreditCardOneClickEntity extends CardOneClickEntity
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
     * CreditCardOneClickEntity constructor.
     * @param $one_click_pay_token
     * @param $number_installments
     */
    public function __construct($one_click_pay_token, $number_installments)
    {
        parent::__construct($one_click_pay_token);
        $this->number_installments = $number_installments;
    }

    /**
     * @return int
     */
    public function getNumberInstallments()
    {
        return $this->number_installments;
    }

    /**
     * @param int $number_installments
     */
    public function setNumberInstallments($number_installments)
    {
        $this->number_installments = $number_installments;
    }

    /**
     * @return mixed
     */
    public function getOperationType()
    {
        return $this->operation_type;
    }
}