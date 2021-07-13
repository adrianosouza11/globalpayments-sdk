<?php

namespace GlobalPayments\Util;

use GlobalPayments\Entity\Banking\CardBanking3DSecurityEntity;
use GlobalPayments\Entity\Banking\CardBankingEntity;
use GlobalPayments\Entity\Banking\OneClickBankingEntity;

abstract class GlobalPaymentXml
{
    const BEGIN_DATOSENTRADA = '<DATOSENTRADA>';
    const END_DATOSENTRADA = '</DATOSENTRADA>';



    public static function getXmlCreditPayment3DSecurity(
        CardBanking3DSecurityEntity $cardBanking3DSecurityEntity,
        string $mid,
        string $terminal,
        string $security_key
    ) : string
    {
        $beginDatosentrada = self::BEGIN_DATOSENTRADA;
        $endDatosentrada = self::END_DATOSENTRADA;

        $getXml = self::getXmlCard($cardBanking3DSecurityEntity, $mid, $terminal);

        $xmlRequired = sprintf("<DS_MERCHANT_PLANINSTALLMENTSNUMBER>%d</DS_MERCHANT_PLANINSTALLMENTSNUMBER>
                            <DS_MERCHANT_IDENTIFIER>REQUIRED</DS_MERCHANT_IDENTIFIER>
                            <DS_MERCHANT_MERCHANTSIGNATURE>%s</DS_MERCHANT_MERCHANTSIGNATURE>
<DS_MERCHANT_ACCEPTHEADER>%s</DS_MERCHANT_ACCEPTHEADER>
<DS_MERCHANT_USERAGENT>%s</DS_MERCHANT_USERAGENT>",
            $cardBanking3DSecurityEntity->getCardEntity()->getNumberInstallments(),
            $security_key,
            $cardBanking3DSecurityEntity->getClientBrowse()->accept,
            $cardBanking3DSecurityEntity->getClientBrowse()->user_agent
        );

        return $beginDatosentrada . $getXml . $xmlRequired . $endDatosentrada;
    }

    public static function getXmlDebitPayment3DSecurity(
        CardBanking3DSecurityEntity $cardBanking3DSecurityEntity,
        string $mid,
        string $terminal,
        string $security_key
    ) : string
    {
        $beginDatosentrada = self::BEGIN_DATOSENTRADA;
        $endDatosentrada = self::END_DATOSENTRADA;

        $getXml = self::getXmlCard($cardBanking3DSecurityEntity, $mid, $terminal);

        $xmlRequired = sprintf("<DS_MERCHANT_IDENTIFIER>REQUIRED</DS_MERCHANT_IDENTIFIER>
<DS_MERCHANT_ACCEPTHEADER>%s</DS_MERCHANT_ACCEPTHEADER>
<DS_MERCHANT_USERAGENT>%s</DS_MERCHANT_USERAGENT>
<DS_MERCHANT_MERCHANTSIGNATURE>%s</DS_MERCHANT_MERCHANTSIGNATURE>
",
            $cardBanking3DSecurityEntity->getClientBrowse()->accept,
            $cardBanking3DSecurityEntity->getClientBrowse()->user_agent,
            $security_key
        );

        return $beginDatosentrada . $getXml . $xmlRequired . $endDatosentrada;
    }

    private static function getXmlCard(CardBankingEntity $cardBankingEntity, string $mid,string $terminal) : string
    {
        return sprintf("<DS_MERCHANT_AMOUNT>%d</DS_MERCHANT_AMOUNT>
                            <DS_MERCHANT_ORDER>%s</DS_MERCHANT_ORDER>
                            <DS_MERCHANT_MERCHANTCODE>%s</DS_MERCHANT_MERCHANTCODE>
                            <DS_MERCHANT_TERMINAL>%s</DS_MERCHANT_TERMINAL>
                            <DS_MERCHANT_CURRENCY>%s</DS_MERCHANT_CURRENCY>
                            <DS_MERCHANT_PAN>%d</DS_MERCHANT_PAN>
                            <DS_MERCHANT_EXPIRYDATE>%d</DS_MERCHANT_EXPIRYDATE>
                            <DS_MERCHANT_CVV2>%s</DS_MERCHANT_CVV2>
                            <DS_MERCHANT_TRANSACTIONTYPE>%s</DS_MERCHANT_TRANSACTIONTYPE>
                            <DS_MERCHANT_ACCOUNTTYPE>%s</DS_MERCHANT_ACCOUNTTYPE>
                            <DS_MERCHANT_PLANTYPE>%d</DS_MERCHANT_PLANTYPE>",
            $cardBankingEntity->getAmount(),
            $cardBankingEntity->getOrderCode(),
            $mid,
            $terminal,
            $cardBankingEntity->getCurrency(),
            $cardBankingEntity->getCardEntity()->getCardNumber(),
            $cardBankingEntity->getCardEntity()->getExpiryDate(),
            $cardBankingEntity->getCardEntity()->getCvv2(),
            $cardBankingEntity->getTransactionType(),
            $cardBankingEntity->getCardEntity()->getOperationType(),
            $cardBankingEntity->getPaymentPlan()
        );
    }

    private static function getXmlOneClickPay(
        OneClickBankingEntity $oneClickBankingEntity,
        string $mid,
        string $terminal
    ) : string
    {
        return sprintf("<DS_MERCHANT_AMOUNT>%d</DS_MERCHANT_AMOUNT>
                            <DS_MERCHANT_ORDER>%s</DS_MERCHANT_ORDER>
                            <DS_MERCHANT_MERCHANTCODE>%s</DS_MERCHANT_MERCHANTCODE>
                            <DS_MERCHANT_TERMINAL>%s</DS_MERCHANT_TERMINAL>
                            <DS_MERCHANT_CURRENCY>%s</DS_MERCHANT_CURRENCY>
                            <DS_MERCHANT_TRANSACTIONTYPE>%s</DS_MERCHANT_TRANSACTIONTYPE>
                            <DS_MERCHANT_ACCOUNTTYPE>%s</DS_MERCHANT_ACCOUNTTYPE>
                            <DS_MERCHANT_PLANTYPE>%d</DS_MERCHANT_PLANTYPE>
                            <DS_MERCHANT_IDENTIFIER>%s</DS_MERCHANT_IDENTIFIER>",
        $oneClickBankingEntity->getAmount(),
        $oneClickBankingEntity->getOrderCode(),
        $mid,
        $terminal,
        $oneClickBankingEntity->getCurrency(),
        $oneClickBankingEntity->getTransactionType(),
        $oneClickBankingEntity->getCardOneClick()->getOperationType(),
        $oneClickBankingEntity->getPaymentPlan(),
        $oneClickBankingEntity->getCardOneClick()->getOneClickPayToken()
        );
    }

    public static function getXmlCreditPayment(
        CardBankingEntity $cardBankingEntity,
        string $mid,
        string $terminal,
        string $security_key
    ) : string
    {
        $beginDatosentrada = self::BEGIN_DATOSENTRADA;
        $endDatosentrada = self::END_DATOSENTRADA;

        $getXml = self::getXmlCard($cardBankingEntity, $mid, $terminal);

        $xmlRequired = sprintf("<DS_MERCHANT_PLANINSTALLMENTSNUMBER>%d</DS_MERCHANT_PLANINSTALLMENTSNUMBER>
                            <DS_MERCHANT_IDENTIFIER>REQUIRED</DS_MERCHANT_IDENTIFIER>
                            <DS_MERCHANT_MERCHANTSIGNATURE>%s</DS_MERCHANT_MERCHANTSIGNATURE>",
            $cardBankingEntity->getCardEntity()->getNumberInstallments(),
            $security_key
        );

        return $beginDatosentrada . $getXml . $xmlRequired . $endDatosentrada;
    }

    public static function getXmlCreditOneClickPay(
        OneClickBankingEntity $oneClickBankingEntity,
        string $mid,
        string $terminal,
        string $security_key
    ) : string
    {
        $beginDatosentrada = self::BEGIN_DATOSENTRADA;
        $endDatosentrada = self::END_DATOSENTRADA;

        $getXml = self::getXmlOneClickPay($oneClickBankingEntity, $mid, $terminal);

        $xmlRequired = sprintf("<DS_MERCHANT_PLANINSTALLMENTSNUMBER>%d</DS_MERCHANT_PLANINSTALLMENTSNUMBER>
                            <DS_MERCHANT_MERCHANTSIGNATURE>%s</DS_MERCHANT_MERCHANTSIGNATURE>",
            $oneClickBankingEntity->getCardOneClick()->getNumberInstallments(),
            $security_key
        );

        return $beginDatosentrada . $getXml . $xmlRequired . $endDatosentrada;
    }

    public static function getXmlRecurringCredit(
        CardBankingEntity $cardBankingEntity,
        string $mid,
        string $terminal,
        string $security_key
    ) : string
    {
        $beginDatosentrada = self::BEGIN_DATOSENTRADA;
        $endDatosentrada = self::END_DATOSENTRADA;

        $getXml = self::getXmlCard($cardBankingEntity, $mid, $terminal);

        $getXml = preg_replace('/<DS_MERCHANT_CVV2>(.*?)<\/DS_MERCHANT_CVV2>/im', '',$getXml);

        $xmlRequired = sprintf("<DS_MERCHANT_PLANINSTALLMENTSNUMBER>%d</DS_MERCHANT_PLANINSTALLMENTSNUMBER>
                            <DS_MERCHANT_RECURRINGPAYMENT>Y</DS_MERCHANT_RECURRINGPAYMENT>
                            <DS_MERCHANT_MERCHANTSIGNATURE>%s</DS_MERCHANT_MERCHANTSIGNATURE>",
            $cardBankingEntity->getCardEntity()->getNumberInstallments(),
            $security_key
        );

        return $beginDatosentrada . $getXml . $xmlRequired . $endDatosentrada;
    }
}