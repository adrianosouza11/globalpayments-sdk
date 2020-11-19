<?php

namespace GlobalPayments\entities;

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
    protected $expirate_date = '';

    /**
     * @var string
     */
    protected $cvv2 = '';

    /**
     * CardEntity constructor.
     * @param string $titular_name
     * @param int $card_number
     * @param string $expirate_date
     * @param string $cvv2
     */
    public function __construct($titular_name, $card_number, $expirate_date, $cvv2)
    {
        $this->titular_name = $titular_name;
        $this->card_number = $card_number;
        $this->expirate_date = $expirate_date;
        $this->cvv2 = $cvv2;
    }


    /**
     * @return string
     */
    public function getTitularName()
    {
        return $this->titular_name;
    }

    /**
     * @param string $titular_name
     */
    public function setTitularName($titular_name)
    {
        $this->titular_name = $titular_name;
    }

    /**
     * @return int
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * @param int $card_number
     */
    public function setCardNumber($card_number)
    {
        $this->card_number = $card_number;
    }

    /**
     * @return string
     */
    public function getExpirateDate()
    {
        return $this->expirate_date;
    }

    /**
     * @param string $expirate_date
     */
    public function setExpirateDate($expirate_date)
    {
        $this->expirate_date = $expirate_date;
    }

    /**
     * @return string
     */
    public function getCvv2()
    {
        return $this->cvv2;
    }

    /**
     * @param string $cvv2
     */
    public function setCvv2($cvv2)
    {
        $this->cvv2 = $cvv2;
    }
}