<?php

namespace GlobalPayments;

use GlobalPayments\BankLog\Entity\BankTransactionLog;
use GlobalPayments\BankLog\Enum\StatusLog;
use GlobalPayments\BankLog\TransactionLog;
use GlobalPayments\Entity\Banking\CancellationPayBankingEntity;
use GlobalPayments\Entity\Banking\CardBankingEntity;
use GlobalPayments\Entity\Banking\OneClickBankingEntity;
use GlobalPayments\Exception\GlobalPaymentException;
use GlobalPayments\Soap\Client;
use GlobalPayments\Traits\GlobalPaymentsServicesTrait;
use GlobalPayments\Util\GlobalPaymentXml;
use GlobalPayments\Util\Utilities;

class GlobalPaymentsServices
{
    use GlobalPaymentsServicesTrait;

    /* @var string $url */
    private $url = '';

    /**@var string $key */
    private $key = '';

    /**@var string $mid */
    private $mid = '';

    /**@var int $terminal */
    private $terminal = 1;

    private $transactionLog;

    public function __construct($url, $key,$mid,$terminal)
    {
        $this->setUrl($url);
        $this->setKey($key);
        $this->setMid($mid);
        $this->setTerminal($terminal);

        $this->transactionLog = new TransactionLog();
    }

    /**
     * @param CardBankingEntity $cardBankingEntity
     * @return array
     * @throws GlobalPaymentException
     */
    public function creditPaymentTransaction(CardBankingEntity $cardBankingEntity) : array
    {
        $security_key = Utilities::generateSecurityKey(
            $cardBankingEntity->getAmount(),
            $cardBankingEntity->getOrderCode(),
            $this->getMid(),
            $cardBankingEntity->getCurrency(),
            $cardBankingEntity->getCardEntity()->getCardNumber(),
            $cardBankingEntity->getCardEntity()->getCvv2(),
            $cardBankingEntity->getTransactionType(),
            $this->getKey()
        );

        $getXml = GlobalPaymentXml::getXmlCreditPayment(
            $cardBankingEntity,
            $this->getMid(),
            $this->getTerminal(),
            $security_key
        );

        $xmlReqArray = Utilities::xmlArray(new \SimpleXMLElement($getXml));

        $obfuscateDataXml = Utilities::obfuscateDataXml($xmlReqArray,[
            'DS_MERCHANT_PAN',
            'DS_MERCHANT_EXPIRYDATE',
            'DS_MERCHANT_CVV2',
            'DS_MERCHANT_MERCHANTSIGNATURE'
        ]);

        $this->transactionLog->addLog(new BankTransactionLog(
            $cardBankingEntity->getOrderCode(),
            "Efetuando transação com cartão de crédito",
            StatusLog::LOG,
            $obfuscateDataXml
        ));

        $doRequest = Client::doRequest($this->getUrl(),$getXml);

        array_walk($doRequest['OPERACION'], function ($val, $key) use (&$result){
            $val = is_array($val) ? implode(',', $val) : $val;
            $result .= "<$key>$val</$key>";
        });

        $this->transactionLog->addLog(new BankTransactionLog(
            $cardBankingEntity->getOrderCode(),
            "Resultado da transação com cartão de crédito",
            StatusLog::SUCCESS,
            $result
        ));

        return $doRequest;
    }

    /**
     * @param OneClickBankingEntity $oneClickBankingEntity
     * @return array
     * @throws GlobalPaymentException
     */
    public function creditOneClickPaymentTransaction(OneClickBankingEntity $oneClickBankingEntity) : array
    {
        $security_key = Utilities::generateOneClickPaymentSecurityKey(
          $oneClickBankingEntity->getAmount(),
          $oneClickBankingEntity->getOrderCode(),
          $this->getMid(),
          $oneClickBankingEntity->getCurrency(),
          $oneClickBankingEntity->getTransactionType(),
          $oneClickBankingEntity->getCardOneClick()->getOneClickPayToken(),
          $this->getKey()
        );

        $getXml = GlobalPaymentXml::getXmlCreditOneClickPay(
            $oneClickBankingEntity,
            $this->getMid(),
            $this->getTerminal(),
            $security_key
        );

        $xmlReqArray = Utilities::xmlArray(new \SimpleXMLElement($getXml));

        $obfuscateDataXml = Utilities::obfuscateDataXml($xmlReqArray,[
            'DS_MERCHANT_MERCHANTSIGNATURE'
        ]);

        $this->transactionLog->addLog(new BankTransactionLog(
            $oneClickBankingEntity->getOrderCode(),
            "Efetuando transação com cartão de crédito 1 um clique",
            StatusLog::LOG,
            $obfuscateDataXml
        ));

        return Client::doRequest($this->getUrl(), $getXml);
    }

    public function recurringCreditCardPayment(CardBankingEntity $cardBankingEntity) : array
    {
        $security_key = Utilities::generateSecurityKey(
            $cardBankingEntity->getAmount(),
            $cardBankingEntity->getOrderCode(),
            $this->getMid(),
            $cardBankingEntity->getCurrency(),
            $cardBankingEntity->getCardEntity()->getCardNumber(),
            null,
            $cardBankingEntity->getTransactionType(),
            $this->getKey(),
            null
        );

        $getXml = GlobalPaymentXml::getXmlRecurringCredit(
            $cardBankingEntity,
            $this->getMid(),
            $this->getTerminal(),
            $security_key
        );

        $xmlReqArray = Utilities::xmlArray(new \SimpleXMLElement($getXml));

        $obfuscateDataXml = Utilities::obfuscateDataXml($xmlReqArray,[
            'DS_MERCHANT_PAN',
            'DS_MERCHANT_EXPIRYDATE',
            'DS_MERCHANT_MERCHANTSIGNATURE'
        ]);

        $this->transactionLog->addLog(new BankTransactionLog(
            $cardBankingEntity->getOrderCode(),
            "Efetuando transação com cartão de crédito recorrente",
            StatusLog::LOG,
            $obfuscateDataXml
        ));

        return Client::doRequest($this->getUrl(),$getXml);
    }

    /**
     * @param CancellationPayBankingEntity $cancellationPayBankingEntity
     * @return array
     * @throws GlobalPaymentException
     */
    public function cancelPaymentTransaction(CancellationPayBankingEntity $cancellationPayBankingEntity) : array
    {
        $security_key = Utilities::generateSecurityKey(
            $cancellationPayBankingEntity->getAmount(),
            $cancellationPayBankingEntity->getOrderCode(),
            $this->getMid(),
            $cancellationPayBankingEntity->getCurrency(),
            null,
            null,
            $cancellationPayBankingEntity->getTransactionType(),
            $this->getKey(),
            null
        );

        $getXml = GlobalPaymentXml::getXmlCancellationPay(
            $cancellationPayBankingEntity,
            $this->getMid(),
            $this->getTerminal(),
            $security_key
        );

        $xmlReqArray = Utilities::xmlArray(new \SimpleXMLElement($getXml));

        $obfuscateDataXml = Utilities::obfuscateDataXml($xmlReqArray,['DS_MERCHANT_MERCHANTSIGNATURE']);

        $this->transactionLog->addLog(new BankTransactionLog(
            $cancellationPayBankingEntity->getOrderCode(),
            "Efetuando transação de cancalamento de pagamento",
            StatusLog::LOG,
            $obfuscateDataXml
        ));

        return Client::doRequest($this->getUrl(),$getXml);
    }
}