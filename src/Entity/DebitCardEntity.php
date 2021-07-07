<?php

namespace GlobalPayments\Entity;

use GlobalPayments\Enum\PaymentMethodEnum;

class DebitCardEntity extends CardEntity
{
    private $operation_type = PaymentMethodEnum::DEBIT_CARD;

    public function getOperationType(){
        return $this->operation_type;
    }
}