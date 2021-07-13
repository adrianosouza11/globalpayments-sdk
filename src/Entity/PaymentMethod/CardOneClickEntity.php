<?php

namespace GlobalPayments\Entity\PaymentMethod;

class CardOneClickEntity
{
    /**
     * @var string $one_click_pay_token
     */
    protected $one_click_pay_token;

    /**
     * CardOneClickEntity constructor.
     * @param string $one_click_pay_token
     */
    public function __construct(string $one_click_pay_token)
    {
        $this->one_click_pay_token = $one_click_pay_token;
    }

    /**
     * @return string
     */
    public function getOneClickPayToken() : string
    {
        return $this->one_click_pay_token;
    }

    /**
     * @param string $one_click_pay_token
     */
    public function setOneClickPayToken(string $one_click_pay_token) : void
    {
        $this->one_click_pay_token = $one_click_pay_token;
    }
}