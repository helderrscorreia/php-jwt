<?php

namespace JWT;

class JWT
{
    /**
     * Get the current password
     * @return string
     */
    public static function getPassword()
    {
        return 'wjk|gFw(F5uw^ePz*^Y"d[Q}WUyN&n';
    }

    /**
     * Generate a JWT token from a payload array
     * @param $payload
     * @return string
     */
    public static function generateToken($payload)
    {
        $password = JWT::getPassword();
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $header = json_encode($header);
        $header = base64_encode($header);

        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        $signature = hash_hmac('sha256', "{$header}.{$payload}", $password, true);
        $signature = base64_encode($signature);

        return "{$header}.{$payload}.{$signature}";
    }

    /**
     * Check if the token is valid
     * @param $token
     * @return bool
     */
    public static function isTokenValid($token)
    {
        $password = JWT::getPassword();

        $part = explode(".", $token);
        $header = $part[0];
        $payload = $part[1];
        $signature = $part[2];

        $valid = hash_hmac('sha256', "{$header}.{$payload}", $password, true);
        $valid = base64_encode($valid);

        return ($signature === $valid);
    }

    /**
     * Get the payload as an PHP object
     * @param $token
     * @return false|mixed
     */
    public static function getPayload($token)
    {
        if (JWT::isTokenValid($token)) {
            $part = explode(".", $token);
            $payload = $part[1];
            $payload = base64_decode($payload);
            $payload = json_decode($payload);

            return $payload;
        } else {
            return false;
        }
    }
}
