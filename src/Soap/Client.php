<?php

namespace GlobalPayments\Soap;

use GlobalPayments\Exception\ErrorHandler;
use GlobalPayments\Exception\GlobalPaymentException;
use GlobalPayments\Util\Utilities;

use \SimpleXMLElement;
use \Exception;

class Client
{
    /**
     * @throws GlobalPaymentException
     * @throws Exception
     */
    public static function doRequest($url,$xml) : array
    {
        $responseXml = self::nusoapRequest($url,$xml);

        $responseArray = Utilities::xmlArray($responseXml);

       $errorHandler = new ErrorHandler($responseArray);

       $errorHandler->checkTransaction();
       $errorHandler->checkOperationProcessing();

        return $responseArray;
    }

    /**
     * @param $url
     * @param $xml
     * @return SimpleXMLElement
     * @throws Exception
     */
    private static function nusoapRequest($url,$xml) : SimpleXMLElement
    {
        $request = new \nusoap_client($url,false);

        $responseXml  = $request->call('trataPeticion', ['datoEntrada' => $xml]);

        if ($request->fault)
            throw new Exception("Fault (Expect - The request contains an invalid SOAP body)");
        else if ($request->getError() != null)
            throw new Exception($request->getError());

        return new SimpleXMLElement($responseXml);
    }


}