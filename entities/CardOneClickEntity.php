<?php


namespace GlobalPayments\entities;

/**
 * Class CardOneClickEntity
 * @package common\components\services\globalpayment\entities
 */
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
    public function __construct($one_click_pay_token)
    {
        $this->one_click_pay_token = $one_click_pay_token;
    }

    /**
     * @return string
     */
    public function getOneClickPayToken()
    {
        return $this->one_click_pay_token;
    }

    /**
     * @param string $one_click_pay_token
     */
    public function setOneClickPayToken($one_click_pay_token)
    {
        $this->one_click_pay_token = $one_click_pay_token;
    }
}