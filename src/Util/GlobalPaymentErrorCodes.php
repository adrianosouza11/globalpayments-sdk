<?php

namespace GlobalPayments\Util;

use GlobalPayments\Exception\GlobalPaymentException;

/**
 * Class GlobalPaymentErrorCodes
 * @package common\components\services\globalpayment\util
 */
class GlobalPaymentErrorCodes
{
    /**
     * @var \string[][]
     */
    private $errorCodes = [
         'SIS0001' => [
             'ds_response' => '9001',
             'description' => 'Erro genérico',
         ],
        'SIS0002' => [
            'ds_response' => '9002',
            'description' => 'Erro genérico',
        ],
        'SIS0007' => [
            'ds_response' => '9007',
            'description' => 'Erro ao desmontar o XML de entrada',
        ],
        'SIS0008' => [
            'ds_response' => '9008',
            'description' => 'Erro falta Ds_Merchant_MerchantCode',
        ],
        'SIS0009' => [
            'ds_response' => '9009',
            'description' => 'Erro de formato no Ds_Merchant_MerchantCode',
        ],
        'SIS0010' => [
            'ds_response' => '9010',
            'description' => 'Erro falta Ds_Merchant_Terminal',
        ],
        'SIS0011' => [
            'ds_response' => '9011',
            'description' => 'Erro de formato no Ds_Merchant_Terminal',
        ],
        'SIS0014' => [
            'ds_response' => '9014',
            'description' => 'Erro de formato no Ds_Merchant_Order',
        ],
        'SIS0015' => [
            'ds_response' => '9015',
            'description' => 'Erro falta Ds_Merchant_Currency',
        ],
        'SIS0016' => [
            'ds_response' => '9016',
            'description' => 'Erro de formato no Ds_Merchant_Currency',
        ],
        'SIS0018' => [
            'ds_response' => '9018',
            'description' => 'Erro falta Ds_Merchant_Amount',
        ],
        'SIS0019' => [
            'ds_response' => '9019',
            'description' => 'Erro de formato no Ds_Merchant_Amount',
        ],
        'SIS0020' => [
            'ds_response' => '9020',
            'description' => 'Erro falta Ds_Merchant_MerchantSignature',
        ],
        'SIS0021' => [
            'ds_response' => '9021',
            'description' => 'Erro a Ds_Merchant_MerchantSignature vem vazia',
        ],
        'SIS0022' => [
            'ds_response' => '9022',
            'description' => 'Erro de formato no Ds_Merchant_TransactionType',
        ],
        'SIS0023' => [
            'ds_response' => '9023',
            'description' => 'Erro Ds_Merchant_TransactionType desconhecido',
        ],
        'SIS0025' => [
            'ds_response' => '9025',
            'description' => 'Erro de formato do Ds_Merchant_ConsumerLanguage',
        ],
        'SIS0026' => [
            'ds_response' => '9026',
            'description' => 'Erro de formato do Ds_Merchant_ConsumerLanguage',
        ],
        'SIS0027' => [
            'ds_response' => '9027',
            'description' => 'Tipo de moeda não habilitada para este terminal',
        ],
        'SIS0028' => [
            'ds_response' => '9028',
            'description' => 'Loja / terminal está desativado',
        ],
        'SIS0030' => [
            'ds_response' => '9030',
            'description' => 'Operação não é válida',
        ],
        'SIS0031' => [
            'ds_response' => '9031',
            'description' => 'Método de pagamento não reconhecido',
        ],
        'SIS0034' => [
            'ds_response' => '9034',
            'description' => 'Erro ao acessar a base de dados',
        ],
        'SIS0035' => [
            'ds_response' => '9035',
            'description' => 'Erro interno de sistema. Não foi possível recuperar dados da sessão.',
        ],
        'SIS0038' => [
            'ds_response' => '9038',
            'description' => 'Erro interno Java.',
        ],
        'SIS0040' => [
            'ds_response' => '9040',
            'description' => 'A loja não possui nenhum método de pagamento habilitado',
        ],
        'SIS0041' => [
            'ds_response' => '9041',
            'description' => 'Erro no cálculo da HASH dos dados da loja',
        ],
        'SIS0042' => [
            'ds_response' => '9042',
            'description' => 'A assinatura enviada não está correta',
        ],
        'SIS0046' => [
            'ds_response' => '9046',
            'description' => 'O BIN do cartão não está ativado',
        ],
        'SIS0051' => [
            'ds_response' => '9051',
            'description' => 'Erro número de pedido repetido',
        ],
        'SIS0054' => [
            'ds_response' => '9054',
            'description' => 'Transação não localizada. Não foi possível realizar o cancelamento',
        ],
        'SIS0055' => [
            'ds_response' => '9055',
            'description' => 'Existe mais de um pagamento com o mesmo número de pedido',
        ],
        'SIS0056' => [
            'ds_response' => '9056',
            'description' => 'Cancelamento não autorizado para esta operação',
        ],
        'SIS0057' => [
            'ds_response' => '9057',
            'description' => 'O valor a ser cancelado supera o permitido',
        ],
        'SIS0058' => [
            'ds_response' => '9058',
            'description' => 'Inconsistência de dados na validação da confirmação da transação',
        ],
        'SIS0059' => [
            'ds_response' => '9059',
            'description' => 'Operação não é válida para realizar a confirmação da transação',
        ],
        'SIS0060' => [
            'ds_response' => '9060',
            'description' => 'Já existe uma confirmação associada à esta pré-autorização',
        ],
        'SIS0061' => [
            'ds_response' => '9060',
            'description' => 'Operação não autorizada para confirmar a pré-autorização',
        ],
        'SIS0062' => [
            'ds_response' => '9062',
            'description' => 'O valor a capturar supera o permitido',
        ],
        'SIS0063' => [
            'ds_response' => '9063',
            'description' => 'Número do cartão não disponível',
        ],
        'SIS0064' => [
            'ds_response' => '9064',
            'description' => 'O número do cartão não pode ter mais de 19 posições',
        ],
        'SIS0065' => [
            'ds_response' => '9065',
            'description' => 'O número do cartão não é numérico',
        ],
        'SIS0066' => [
            'ds_response' => '9066',
            'description' => 'Mês de expiração não disponível',
        ],
        'SIS0067' => [
            'ds_response' => '9067',
            'description' => 'O mês de expiração não é numérico',
        ],
        'SIS0068' => [
            'ds_response' => '9068',
            'description' => 'O mês da expiração não é válido',
        ],
        'SIS0069' => [
            'ds_response' => '9069',
            'description' => 'Ano de expiração não disponível',
        ],
        'SIS0070' => [
            'ds_response' => '9070',
            'description' => 'O ano de expiração não é numérico',
        ],
        'SIS0071' => [
            'ds_response' => '9071',
            'description' => 'Cartão expirado',
        ],
        'SIS0072' => [
            'ds_response' => '9072',
            'description' => 'Operação não é possível de ser anulada',
        ],
        'SIS0073' => [
            'ds_response' => '9073',
            'description' => 'O ano de expiração não é numérico',
        ],
        'SIS0074' => [
            'ds_response' => '9074',
            'description' => 'Erro falta Ds_Merchant_Order',
        ],
        'SIS0075' => [
            'ds_response' => '9075',
            'description' => 'Erro o Ds_Merchant_Order tem menos de 4 posições ou mais de 12',
        ],
        'SIS0076' => [
            'ds_response' => '9076',
            'description' => 'Erro o Ds_Merchant_Order não possui as 4 primeiras posições preenchidas com
números.',
        ],
        'SIS0077' => [
            'ds_response' => '9077',
            'description' => 'Erro o Ds_Merchant_Order não está formatado corretamente.',
        ],
        'SIS0078' => [
            'ds_response' => '9078',
            'description' => 'Método de pagamento não disponível',
        ],
        'SIS0079' => [
            'ds_response' => '9079',
            'description' => 'Erro ao realizar o pagamento com cartão',
        ],
        'SIS0081' => [
            'ds_response' => '9081',
            'description' => 'Nova sessão, os dados armazenados foram perdidos',
        ],
        'SIS0089' => [
            'ds_response' => '9089',
            'description' => 'O valor de Ds_Merchant_ExpiryDate não ocupa 4 posições',
        ],
        'SIS0092' => [
            'ds_response' => '9092',
            'description' => 'O valor de Ds_Merchant_ExpiryDate é nulo',
        ],
        'SIS0093' => [
            'ds_response' => '9093',
            'description' => 'Cartão não reconhecido',
        ],
        'SIS0112' => [
            'ds_response' => '9112',
            'description' => 'Erro tipo de transação especificado em Ds_Merchant_Transaction_Type não é
permitido',
        ],
        'SIS0114' => [
            'ds_response' => '9114',
            'description' => 'Está realizando a chamada por GET, é necessário realizá-la por POST',
        ],
        'SIS0132' => [
            'ds_response' => '9132',
            'description' => 'A data da captura não pode superar mais de 7 dias a partir da pré-autorização',
        ],
        'SIS0142' => [
            'ds_response' => '9142',
            'description' => 'Tempo excedido para o pagamento',
        ],
        'SIS0181' => [
            'ds_response' => '9181',
            'description' => 'Erro interno da Redsys - Erro ao montar o XML com os dados recebidos.',
        ],
        'SIS0184' => [
            'ds_response' => '9184',
            'description' => 'Erro interno da Redsys - Erro ao tratar o XML do recebo.',
        ],
        'SIS0216' => [
            'ds_response' => '9216',
            'description' => 'Erro Ds_Merchant_CVV2 tem mais de 3 ou 4 posições',
        ],
        'SIS0217' => [
            'ds_response' => '9217',
            'description' => 'Erro de formato em Ds_Merchant_CVV2',
        ],
        'SIS0221' => [
            'ds_response' => '9221',
            'description' => 'CVV2 é obrigatório',
        ],
        'SIS0222' => [
            'ds_response' => '9222',
            'description' => 'Já existe um cancelamento associado à pré-autorização',
        ],
        'SIS0223' => [
            'ds_response' => '9223',
            'description' => 'Cancelamento da Pré-autorização não autorizada',
        ],
        'SIS0225' => [
            'ds_response' => '9225',
            'description' => 'Não existe transação para realizar o cancelamento',
        ],
        'SIS0226' => [
            'ds_response' => '9226',
            'description' => 'Inconsistência de dados na validação de cancelamento da transação',
        ],
        'SIS0227' => [
            'ds_response' => '9227',
            'description' => 'Valor do campo DS_MERCHANT_TRANSACTIONDATE não é válido',
        ],
        'SIS0252' => [
            'ds_response' => '9252',
            'description' => 'A loja não permite o envio do cartão',
        ],
        'SIS0253' => [
            'ds_response' => '9253',
            'description' => 'Verifique se o seu cartão é válido',
        ],
        'SIS0261' => [
            'ds_response' => '9261',
            'description' => 'Operação cancelada, pois, infringe o controle de restrições na entrada ao
sistema',
        ],
        'SIS0274' => [
            'ds_response' => '9274',
            'description' => 'Operação desconhecida ou não permitida na entrada ao sistema',
        ],
        'SIS0414' => [
            'ds_response' => '9414',
            'description' => 'O plano de venda não está correto',
        ],
        'SIS0415' => [
            'ds_response' => '9415',
            'description' => 'O tipo de produto não está correto',
        ],
        'SIS0416' => [
            'ds_response' => '9416',
            'description' => 'Valor não permitido para cancelamento',
        ],
        'SIS0417' => [
            'ds_response' => '9417',
            'description' => 'Cancelamento não permitido por exceder o prazo limite',
        ],
        'SIS0418' => [
            'ds_response' => '9418',
            'description' => 'Não existe plano de vendas vigente para esta operação',
        ],
        'SIS0419' => [
            'ds_response' => '9419',
            'description' => 'O valor do campo DS_MERCHANT_ACCOUNTTYPE (CRE/DEB) é incompatível a
configuração do cartão',
        ],
        'SIS0420' => [
            'ds_response' => '9420',
            'description' => 'A loja não possui este tipo de pagamento habilitado para este tipo de operação.',
        ],
        'SIS0423' => [
            'ds_response' => '9423',
            'description' => 'CNPJ do estabelecimento está incorreto.',
        ],
        'SIS0428' => [
            'ds_response' => '9428',
            'description' => 'Transação de débito não autenticada. Verifique se o seu sistema está
corretamente configurado pois este tipo de transação não é permitida.',
        ],
        'SIS0466' => [
            'ds_response' => '9466',
            'description' => 'A referência utilizada para este pagamento não existe. Verifique os dados da
transação.',
        ],
        'SIS0467' => [
            'ds_response' => '9467',
            'description' => 'A referência utilizada para este pagamento já está processada.',
        ],
        'SIS0468' => [
            'ds_response' => '9468',
            'description' => 'A referência da transação utilizada não é válida para o adquirente.',
        ],
        'SIS0481' => [
            'ds_response' => '9481',
            'description' => 'O estabelecimento não pertence a um Facilitador de Pagamentos.',
        ],
        'SIS0489' => [
            'ds_response' => '9489',
            'description' => 'Erro nos dados de solicitação de venda autenticada. Operação com MPI Externo
não é permitida. Verifique se os campos adequados estão presentes.',
        ],
        'SIS0490' => [
            'ds_response' => '9490',
            'description' => 'Erro nos dados na mensagem do comércio eletrônico. Existem parâmetros de
autenticação 3DSecure Interno em uma operação com MPI Externo. Em uma
operação com dados de MPI externo no se permitem os parâmetros
DS_MERCHANT_ACCEPTHEADER e DS_MERCHANT_USERAGENT.',
        ],
        'SIS0491' => [
            'ds_response' => '9491',
            'description' => 'Erro nos dados na mensagem do comércio eletrônico. SecLevel não permitido
em uma operação de MPI Externo. Revise os possíveis valores deste campo.',
        ],
        'SIS0492' => [
            'ds_response' => '9492',
            'description' => 'Erro nos dados na mensagem do comércio eletrônico. Existem parâmetros de
MPI Externo em uma operação de autenticação 3DS Interna. Em uma operação
3DSecure Interna não são permitidos os parâmetros DS_MERCHANT_SECLEVEL,
DS_MERCHANT_TXID e DS_MERCHANT_CAVV.',
        ],
        'SIS0493' => [
            'ds_response' => '9493',
            'description' => 'Parâmetros de transação segura recebidos em uma solicitação de pagamento
não seguro.
O campo DS_MERCHANT_TRANSACTIONTYPE=A não é compatível com os
parâmetros DS_MERCHANT_ACCEPTHEADER e DS_MERCHANT_USERAGENT.',
        ],
        'SIS0494' => [
            'ds_response' => '9494',
            'description' => 'Mensagem contém um tipo de assinatura que não é válida para esta conexão.',
        ],
        'SIS0524' => [
            'ds_response' => '9524',
            'description' => 'Não é possível realizar a autenticação 3DSecure MasterCard SecureCode
Externo porque não está presente o campo CAVV do emissor na mensagem de
solicitação autorização.',
        ],
    ];

    /**
     * @param $sis_code
     * @return string[]|null
     */
    public function getErrorCodes($sis_code){
        return isset($this->errorCodes[$sis_code]) ? $this->errorCodes[$sis_code] : null;
    }

    /**
     * @param $sis_code
     * @throws GlobalPaymentException
     */
    public function throwExceptionSisCode($sis_code){
        if($this->getErrorCodes($sis_code) != null){
            $description = "$sis_code - " . $this->errorCodes[$sis_code]['description'];
            $dsResponse_code = (int) $this->errorCodes[$sis_code]['ds_response'];
            throw new GlobalPaymentException($description,$dsResponse_code);
        }
    }
}