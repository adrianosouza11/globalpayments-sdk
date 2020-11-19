<?php

namespace GlobalPayments\entities;

use GlobalPayments\enum\CurrencyEnum;
use GlobalPayments\enum\TransactionTypeEnum;

class CardBanking3DSecurityEntity extends CardBankingEntity
{
    /**
     * @var array $clientBrowse
     */
    private $clientBrowse = [];

    /**
     * CardBankingEntity constructor.
     * @param int $amount
     * @param string $order_code
     * @param CardEntity $cardEntity
     * @param int $paymentPlan
     * @param array $arrayClientBrowse
     * @param int $currency
     */
    public function __construct($amount, $order_code,CardEntity $cardEntity,$paymentPlan,array $arrayClientBrowse,$currency = CurrencyEnum::CURRENCY_BRAZIL)
    {
        parent::__construct($amount, $order_code, $cardEntity, $paymentPlan,$currency);

        $this->setTransactionType(TransactionTypeEnum::AUTHORIZATION_3D_SECURE);
        $this->setClientBrowse($arrayClientBrowse);
    }

    /**
     * @param array $arrayClientBrowse
     * @return void
     */
    public function setClientBrowse(array $arrayClientBrowse){
        $this->clientBrowse = new \stdClass();

        if (!isset($arrayClientBrowse['user_agent'], $arrayClientBrowse['accept']))
            throw new \InvalidArgumentException("user_agent, accept required");

        foreach ($arrayClientBrowse as $key => $value){
            $this->clientBrowse->$key = $value;
        }
    }

    /**
     * @return array \stdClass $clientBrowse
     */
    public function getClientBrowse(){
        return $this->clientBrowse;
    }
}