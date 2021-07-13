<?php

namespace GlobalPayments\BankLog\Entity;

class BankTransactionLog
{
    /** @var string $orderCode */
    private $orderCode;

    /** @var int $transactionReturnCode */
    private $transactionReturnCode;

    /**@var string $description */
    private $description;

    /** @var string $requestBody */
    private $requestBody;

    /** @var string $status */
    private $status;

    /**
     * BankTransactionLog constructor.
     * @param string $orderCode
     * @param int $transactionReturnCode
     * @param string $description
     * @param string $requestBody
     * @param string $status
     */
    public function __construct(string $orderCode, string $description, string $status,string $requestBody,int $transactionReturnCode=0)
    {
        $this->orderCode = $orderCode;
        $this->transactionReturnCode = $transactionReturnCode;
        $this->description = $description;
        $this->requestBody = $requestBody;
        $this->status = $status;
    }


    /**
     * @return string
     */
    public function getOrderCode() : string
    {
        return $this->orderCode;
    }

    /**
     * @param string $orderCode
     */
    public function setOrderCode(string $orderCode) : void
    {
        $this->orderCode = $orderCode;
    }

    /**
     * @return int
     */
    public function getTransactionReturnCode() : int
    {
        return $this->transactionReturnCode;
    }

    /**
     * @param int $transactionReturnCode
     */
    public function setTransactionReturnCode(int $transactionReturnCode) : void
    {
        $this->transactionReturnCode = $transactionReturnCode;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getRequestBody() : string
    {
        return $this->requestBody;
    }

    /**
     * @param string $requestBody
     */
    public function setRequestBody(string $requestBody) : void
    {
        $this->requestBody = $requestBody;
    }

    /**
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status) : void
    {
        $this->status = $status;
    }

}