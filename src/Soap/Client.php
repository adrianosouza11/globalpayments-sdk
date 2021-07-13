<?php

namespace GlobalPayments\Soap;

use GlobalPayments\Exception\GlobalPaymentException;
use GlobalPayments\Util\GlobalPaymentErrorCodes;
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
        $globalPaymentErrors = new GlobalPaymentErrorCodes();

        $response = self::nusoapRequest($url,$xml);

        $toArray = Utilities::xmlArray($response);

        $sis_codigo = $toArray['CODIGO'];

        if ($sis_codigo != '0') {
            $globalPaymentErrors->throwExceptionSisCode($sis_codigo);
        }

        return $toArray;
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