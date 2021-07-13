<?php

namespace GlobalPayments\BankLog;

use GlobalPayments\BankLog\Entity\BankTransactionLog;

class TransactionLog
{
    /** @var array $log */
    private $bankTransactionLog = array();

    public function addLog(BankTransactionLog $bankTransactionLog) : void
    {
        $this->bankTransactionLog[] = $bankTransactionLog;
    }

    public function getLogs() : array
    {
        return $this->bankTransactionLog;
    }
}