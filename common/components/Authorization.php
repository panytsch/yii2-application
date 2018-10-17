<?php

namespace common\components;

class Authorization
{
    public static $key = 'PxWq7sjURkjnS4H5YGm60K3LmYFMnwYMATeaXMkt0zIWBjrHf1';
    public static $method = 'AES-256-CBC';

    /**
     * @param string $token
     * @return string
     */
    public static function decode(string $token) :string
    {
        $iv = substr(hash('sha256', self::$key), 0, 16);
        return openssl_decrypt(base64_decode($token), self::$method, self::$key, 0, $iv);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function encode(string $string) :string
    {
        $iv = substr(hash('sha256', self::$key), 0, 16);
        $output = openssl_encrypt($string, self::$method, self::$key, 0, $iv);
        return base64_encode($output);
    }
}