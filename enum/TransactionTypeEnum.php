<?php


namespace GlobalPayments\enum;


abstract class TransactionTypeEnum
{
    const AUTHORIZATION = 'A';

    const AUTHORIZATION_3D_SECURE = '0';

    const PRE_AUTHORIZATION = '1';
}