<?php

namespace GlobalPayments\Entity\PaymentMethod;

class CardEntity {
    /**
     * @var string
     */
    protected $titular_name = '';

    /**
     * @var int
     */
    protected $card_number = 0;

    /**
     * @var string
     */
    protected $expiry_date = '';

    /**
     * @var string
     */
    protected $cvv2 = '';

    /**
     * CardEntity constructor.
     * @param string $titular_name
     * @param int $card_number
     * @param string $expiry_date
     * @param string|null $cvv2
     */
    public function __construct(string $titular_name,int $card_number,string $expiry_date,string $cvv2=null)
    {
        $this->titular_name = $titular_name;
        $this->card_number = $card_number;
        $this->expiry_date = $expiry_date;
        $this->cvv2 = $cvv2;
    }


    /**
     * @return string
     */
    public function getTitularName() : string
    {
        return $this->titular_name;
    }

    /**
     * @param string $titular_name
     */
    public function setTitularName(string $titular_name) : void
    {
        $this->titular_name = $titular_name;
    }

    /**
     * @return int
     */
    public function getCardNumber() : int
    {
        return $this->card_number;
    }

    /**
     * @param int $card_number
     */
    public function setCardNumber(int $card_number) : void
    {
        $this->card_number = $card_number;
    }

    /**
     * @return string
     */
    public function getExpiryDate() : string
    {
        return $this->expiry_date;
    }

    /**
     * @param string $expiry_date
     */
    public function setExpiryDate(string $expiry_date) : void
    {
        $this->expiry_date = $expiry_date;
    }

    /**
     * @return string
     */
    public function getCvv2() : ? string
    {
        return $this->cvv2;
    }

    /**
     * @param string $cvv2
     */
    public function setCvv2(string $cvv2 = null) : void
    {
        $this->cvv2 = $cvv2;
    }
}