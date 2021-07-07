<?php

namespace GlobalPayments;

use GlobalPayments\BankLog\entities\BankTransactionLog;
use GlobalPayments\BankLog\enum\StatusLog;
use GlobalPayments\BankLog\TransactionLog;
use GlobalPayments\Entity\CardBankingEntity;
use GlobalPayments\Entity\OneClickBankingEntity;
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

        return Client::doRequest($this->getUrl(),$getXml);
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
}