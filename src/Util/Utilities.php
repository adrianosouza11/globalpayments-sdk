<?php

namespace GlobalPayments\Util;

abstract class Utilities
{
    public static function generateSecurityKey(
        $amount,
        $order_code,
        $mid,
        $currency,
        $card_number,
        $cvv2,
        $transactionType,
        $key,
        $identifier = 'REQUIRED'
    ){
        $str = "$amount$order_code$mid$currency$card_number$cvv2$transactionType$identifier$key";

        return self::generateKeyHash256($str);
    }

    public static function generateOneClickPaymentSecurityKey(
        $amount,
        $order_code,
        $mid,
        $currency,
        $transaction_type,
        $one_click_pay_token,
        $key
    )
    {
        return self::generateKeyHash256("$amount$order_code$mid$currency$transaction_type$one_click_pay_token$key");
    }

    public static function generateKeyHash256($str){
        return hash('sha256', $str);
    }

    public static function formatRealCurrencyValue($value){
        if ($value < 1.00)
            $value = $value * 100;
        else
            $value = number_format($value, 2, '', '');

        return preg_replace("/[^0-9]/","", $value);
    }

    public static function obfuscateDataXml(array $dataXml, array $obfuscateData){
        $str = '';

        foreach ($dataXml as $key => $value){
            if (!in_array($key, $obfuscateData))
                $str .= "<$key>$value</$key>";
        }

        return $str;
    }

    public static function xmlArray ( $xmlObject, $out = array () )
    {
        foreach ( (array) $xmlObject as $index => $node )
            $out[$index] = ( is_object ( $node ) ) ? self::xmlArray( $node ) : $node;

        return $out;
    }
}