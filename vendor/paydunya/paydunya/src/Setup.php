<?php

namespace Paydunya;

class Setup extends Paydunya
{
  //replace with  production infos after TEST_OPR_BASE_URL: pour les infos de la prod, les stocker dans  des variables d'environnement
    private static $masterKey='cUYDmiSf-Qi44-Q01W-YUxg-A99OYadRzgA0';
    private static $privateKey='test_private_1njz5YYHaYlnaZYEmWMzlRJJhhD';
    private static $publicKey='test_public_SXCURdDUdAxV9wcFlcZewbPJwK1';
    private static $token='rmzOL4yC3yrqdmXoWjAq';

    const ROOT_URL_BASE = "https://app.paydunya.com";

    const LIVE_CHECKOUT_INVOICE_BASE_URL = "/api/v1/checkout-invoice/create";
    const TEST_CHECKOUT_INVOICE_BASE_URL = "/sandbox-api/v1/checkout-invoice/create";

    const LIVE_CHECKOUT_CONFIRM_BASE_URL = "/api/v1/checkout-invoice/confirm/";
    const TEST_CHECKOUT_CONFIRM_BASE_URL = "/sandbox-api/v1/checkout-invoice/confirm/";

    const LIVE_OPR_BASE_URL = "/api/v1/opr/create";
    const TEST_OPR_BASE_URL = "/sandbox-api/v1/opr/create";

    const LIVE_OPR_CHARGE_BASE_URL = "/api/v1/opr/charge";
    const TEST_OPR_CHARGE_BASE_URL = "/sandbox-api/v1/opr/charge";

    const LIVE_DIRECT_PAY_CREDIT_BASE_URL = "/api/v1/direct-pay/credit-account";
    const TEST_DIRECT_PAY_CREDIT_BASE_URL = "/sandbox-api/v1/direct-pay/credit-account";

    private static $mode = "test";

    // prevent instantiation of this class
    private function __construct(){}

    public static function setMasterKey($masterKey)
    {
        self::$masterKey = $masterKey;
    }

    public static function setPrivateKey($privateKey)
    {
        self::$privateKey = $privateKey;
    }

    public static function setPublicKey($publicKey)
    {
        self::$publicKey = $publicKey;
    }

    public static function setToken($token)
    {
        self::$token = $token;
    }

    public static function setMode($mode)
    {
        self::$mode = $mode;
    }

    public static function getMasterKey()
    {
        return self::$masterKey;
    }

    public static function getPrivateKey()
    {
        return self::$privateKey;
    }

    public static function getPublicKey()
    {
        return self::$publicKey;
    }

    public static function getToken()
    {
        return self::$token;
    }

    public static function getMode()
    {
        return self::$mode;
    }

    public static function getCheckoutConfirmUrl()
    {
        if (self::getMode() == "live") {
            return self::ROOT_URL_BASE . self::LIVE_CHECKOUT_CONFIRM_BASE_URL;
        } else {
            return self::ROOT_URL_BASE . self::TEST_CHECKOUT_CONFIRM_BASE_URL;
        }
    }

    public static function getCheckoutBaseUrl()
    {
        if (self::getMode() == "live") {
            return self::ROOT_URL_BASE . self::LIVE_CHECKOUT_INVOICE_BASE_URL;
        } else {
            return self::ROOT_URL_BASE . self::TEST_CHECKOUT_INVOICE_BASE_URL;
        }
    }

    public static function getOPRInvoiceUrl()
    {
        if (self::getMode() == "live") {
            return self::ROOT_URL_BASE . self::LIVE_OPR_BASE_URL;
        } else {
            return self::ROOT_URL_BASE . self::TEST_OPR_BASE_URL;
        }
    }

    public static function getOPRChargeUrl()
    {
        if (self::getMode() == "live") {
            return self::ROOT_URL_BASE . self::LIVE_OPR_CHARGE_BASE_URL;
        } else {
            return self::ROOT_URL_BASE . self::TEST_OPR_CHARGE_BASE_URL;
        }
    }

    public static function getDirectPayCreditUrl()
    {
        if (self::getMode() == "live") {
            return self::ROOT_URL_BASE . self::LIVE_DIRECT_PAY_CREDIT_BASE_URL;
        } else {
            return self::ROOT_URL_BASE . self::TEST_DIRECT_PAY_CREDIT_BASE_URL;
        }
    }

}
