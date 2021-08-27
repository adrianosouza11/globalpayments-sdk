<?php

namespace GlobalPayments\Exception;

use Exception;
use GlobalPayments\Util\GlobalPaymentErrorCodes;

class ErrorHandler
{
    private $fileUrl = DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'errors_ds_response_ds_responseint.json';

    private $loadErrorsDsResponse;

    private $responseSet;

    /**
     * @throws Exception
     */
    public function __construct(array $response)
    {
        $this->loadFileDsResponse();
        $this->responseSet = $response;
    }

    private function loadFileDsResponse() : void
    {
        $this->loadErrorsDsResponse = file_get_contents(dirname(__DIR__,2) . $this->fileUrl);

        if (!$this->loadErrorsDsResponse)
            throw new Exception("Não foi possivel carregar o arquivo");

        $this->loadErrorsDsResponse = json_decode($this->loadErrorsDsResponse, true);
    }

    /**
     * @throws GlobalPaymentException
     */
    public function checkTransaction() : void
    {
        if (isset($this->responseSet['CODIGO']) && $this->responseSet['CODIGO'] != '0')
            (new GlobalPaymentErrorCodes())->throwExceptionSisCode($this->responseSet['CODIGO']);
    }

    /**
     * @throws GlobalPaymentException
     */
    public function checkOperationProcessing() : void
    {
        $wasProcessed = isset($this->responseSet['OPERACION'])
            && isset($this->responseSet['OPERACION']['Ds_Response'])
            && in_array((int)$this->responseSet['OPERACION']['Ds_Response'],[0,900,400]);

        if (!$wasProcessed)
            $this->throwsDsResponseError();
    }

    /**
     * @throws GlobalPaymentException
     */
    private function throwsDsResponseError()
    {
        $getDsResponse = $this->loadErrorsDsResponse['DS_RESPONSE'];

        $message = '';

        if (isset($getDsResponse[(int)$this->responseSet['OPERACION']['Ds_Response']])) {
            $getDsResponse = $getDsResponse[(int)$this->responseSet['OPERACION']['Ds_Response']];

            $getBodyError = $getDsResponse;

            if (isset($this->responseSet['OPERACION']['Ds_ResponseInt']) && isset($getDsResponse['DS_RESPONSEINT'])){
                $getDsResponseIntSet = $getDsResponse['DS_RESPONSEINT'];

                if (isset($getDsResponseIntSet[(int)$this->responseSet['OPERACION']['Ds_ResponseInt']]))
                    $getBodyError = $getDsResponseIntSet[(int)$this->responseSet['OPERACION']['Ds_ResponseInt']];
            }

            $message = !empty($getBodyError['description']) ? $getBodyError['description'] . " - " . $getBodyError['action'] : '';
        }

        throw new GlobalPaymentException(
            strlen($message) > 0 ? $message : "Ocorreu um erro e não foi possível localizar",
            500
        );
    }
}