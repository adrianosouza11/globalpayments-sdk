<?php

namespace GlobalPayments;

use GlobalPayments\entities\CardBankingEntity;
use GlobalPayments\entities\OneClickBankingEntity;
use GlobalPayments\exceptions\GlobalPaymentException;
use GlobalPayments\util\GlobalPaymentErrorCodes;
use GlobalPayments\util\GlobalPaymentXml;
use GlobalPayments\util\Utilities;
//use common\models\sale\BankTransactionLog;

class GlobalPaymentsServices
{

    /**
     * @var string
     */
    private $url = '';

    /**
     * string
     */
    private $key = '';

    /**
     * @var string
     */
    private $mid = '';

    private $terminal = 1;

    /**
     * GlobalPaymentService constructor.
     */
    public function __construct($url, $key,$mid,$terminal)
    {
        $this->setUrl($url);
        $this->setKey($key);
        $this->setMid($mid);
        $this->setTerminal($terminal);
    }

    public function creditPaymentTransaction(CardBankingEntity $cardBankingEntity){
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

        $getXml = GlobalPaymentXml::getXmlCreditPayment($cardBankingEntity, $this->getMid(),$this->getTerminal(),$security_key);

        $getRequestAuth = $this->doRequestAuth($cardBankingEntity, $getXml);

        /*$description = "Transação efetivada com sucesso";
        $this->addLog($cardBankingEntity->getOrderCode(), $description, BankTransactionLog::STATUS_SUCCESS,null);*/

        return $getRequestAuth;
    }

    public function creditOneClickPaymentTransaction(OneClickBankingEntity $oneClickBankingEntity){
        $security_key = Utilities::generateOneClickPaymentSecurityKey(
          $oneClickBankingEntity->getAmount(),
          $oneClickBankingEntity->getOrderCode(),
          $this->getMid(),
          $oneClickBankingEntity->getCurrency(),
          $oneClickBankingEntity->getTransactionType(),
          $oneClickBankingEntity->getCardOneClick()->getOneClickPayToken(),
          $this->getKey()
        );

        $getXml = GlobalPaymentXml::getXmlCreditOneClickPay($oneClickBankingEntity, $this->getMid(),$this->getTerminal(),$security_key);

        $getRequestAuth = $this->doRequestAuthOneClick($oneClickBankingEntity, $getXml);

        return $getRequestAuth;
    }

    /**
     * @param $xml
     * @return \SimpleXMLElement
     * @throws \Exception
     */
    private function nusoapRequest($xml){
        $request = new \nusoap_client($this->getUrl(),false);

        $responseXml  = $request->call('trataPeticion', ['datoEntrada' => $xml]);

        if ($request->fault)
            throw new \Exception("Fault (Expect - The request contains an invalid SOAP body)");
        else if ($request->getError() != null)
            throw new \Exception($request->getError());

        return new \SimpleXMLElement($responseXml);
    }

    private function doRequestAuth(CardBankingEntity $cardBankingEntity, $xml){
        $globalPaymentErrors = new GlobalPaymentErrorCodes();

        try{

            $response = $this->nusoapRequest($xml);
            $toArray = Utilities::xmlArray($response);

            $order_code = $cardBankingEntity->getOrderCode();
            $sis_codigo = $toArray['CODIGO'];

            $xmlReqArray = Utilities::xmlArray(new \SimpleXMLElement($xml));

            $obfuscateDataXml = Utilities::obfuscateDataXml($xmlReqArray,[
                'DS_MERCHANT_PAN',
                'DS_MERCHANT_EXPIRYDATE',
                'DS_MERCHANT_CVV2',
                'DS_MERCHANT_MERCHANTSIGNATURE'
            ]);

            if ($sis_codigo != '0'){
                $globalPaymentErrors->throwExceptionSisCode($sis_codigo);
            }

            /*$sis_codigo = $toArray['CODIGO'];
            $arrayDatoEntrada = $toArray['RECIBIDO']['DATOSENTRADA'];*/
        }catch (GlobalPaymentException $e){
            $description = $e->getMessage();

            //$this->addLog($order_code, $description, BankTransactionLog::STATUS_ERROR,$obfuscateDataXml,$sis_codigo);

            throw new GlobalPaymentException($e->getMessage());

        }catch (\Exception $e){
            $description = $e->getMessage();
            $getCodigo = $e->getCode();

            //$this->addLog($order_code, $description, BankTransactionLog::STATUS_ERROR,$obfuscateDataXml,"$getCodigo");

            throw new \Exception($e->getMessage());
        }

        return $toArray;
    }

    private function doRequestAuthOneClick(OneClickBankingEntity $oneClickBankingEntity, $xml){
        $globalPaymentErrors = new GlobalPaymentErrorCodes();

        try{
            $response = $this->nusoapRequest($xml);
            $toArray = Utilities::xmlArray($response);

            $order_code = $oneClickBankingEntity->getOrderCode();
            $sis_code = $toArray['CODIGO'];

            $xmlReqArray = Utilities::xmlArray(new \SimpleXMLElement($xml));

            $obfuscateDataXml = Utilities::obfuscateDataXml($xmlReqArray,[
                'DS_MERCHANT_PAN',
                'DS_MERCHANT_EXPIRYDATE',
                'DS_MERCHANT_CVV2',
                'DS_MERCHANT_MERCHANTSIGNATURE'
            ]);

            if ($sis_code != '0'){
                $globalPaymentErrors->throwExceptionSisCode($sis_code);
            }

        }catch (GlobalPaymentException $e){
            $description = $e->getMessage();

            $this->addLog($order_code, $description, BankTransactionLog::STATUS_ERROR,$obfuscateDataXml,$sis_code);

            throw new GlobalPaymentException($e->getMessage());

        }catch (\Exception $e){
            $description = $e->getMessage();
            $getCodigo = $e->getCode();

            $this->addLog($order_code, $description, BankTransactionLog::STATUS_ERROR,$obfuscateDataXml,"$getCodigo");

            throw new \Exception($e->getMessage());
        }

        return $toArray;
    }

    private function addLog($order_code,$description, $status,$request_body,$transaction_return_code='0'){
        $mBankTransLog = new BankTransactionLog();
        $mBankTransLog->order_code = $order_code;
        $mBankTransLog->description = $description;
        $mBankTransLog->status = $status;
        $mBankTransLog->transaction_return_code = $transaction_return_code;
        $mBankTransLog->request_body = $request_body;

        if (!$mBankTransLog->save()){

            $getErrors = $mBankTransLog->getErrorSummary(true);

            $text = '';
            foreach ($getErrors as $eachError)
                $text .= "$eachError\n";

            throw new \Exception("Ocorreu um erro ao tentar salvar log da transação bancária: $text");
        }
    }

    /**
     * @return string
     */
    public function getMid()
    {
        return $this->mid;
    }

    /**
     * @param string $mid
     */
    public function setMid($mid)
    {
        $this->mid = $mid;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param int $terminal
     */
    public function setTerminal($terminal)
    {
        $this->terminal = $terminal;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
}