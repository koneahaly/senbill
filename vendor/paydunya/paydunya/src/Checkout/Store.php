<?php

namespace Paydunya\Checkout;

use Paydunya\Paydunya;

class Store extends Paydunya
{
    private static $name='Elektra';
    private static $tagline='Gérez vos factures et paiements';
    private static $postalAddress;
    private static $phoneNumber;
    private static $websiteUrl='http://www.services2sn.com';
    private static $logoUrl='https://elektra.s3.amazonaws.com/images/icons/logo-s2sn.png';
    private static $cancelUrl;
    private static $returnUrl='http://localhost:8000/mes-factures/eau/';
    private static $callbackUrl='http://localhost:8000/notification-paiement';

    public static function setName($name)
    {
        self::$name = $name;
    }

    public static function setTagline($tagline)
    {
        self::$tagline = $tagline;
    }

    public static function setPostalAddress($postalAddress)
    {
        self::$postalAddress = $postalAddress;
    }

    public static function setPhoneNumber($phoneNumber)
    {
        self::$phoneNumber = $phoneNumber;
    }

    public static function setWebsiteUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            self::$websiteUrl = $url;
        }
    }

    public static function setLogoUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            self::$logoUrl = $url;
        }
    }

    public static function setCancelUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            self::$cancelUrl = $url;
        }
    }

    public static function setReturnUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            self::$returnUrl = $url;
        }
    }

    public static function setCallbackUrl($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            self::$callbackUrl = $url;
        }
    }

    public static function getName()
    {
        return self::$name;
    }

    public static function getTagline()
    {
        return self::$tagline;
    }

    public static function getPostalAddress()
    {
        return self::$postalAddress;
    }

    public static function getPhoneNumber()
    {
        return self::$phoneNumber;
    }

    public static function getWebsiteUrl()
    {
        return self::$websiteUrl;
    }

    public static function getLogoUrl()
    {
        return self::$logoUrl;
    }

    public static function getCancelUrl()
    {
        return self::$cancelUrl;
    }

    public static function getReturnUrl()
    {
        return self::$returnUrl;
    }

    public static function getCallbackUrl()
    {
        return self::$callbackUrl;
    }
}
