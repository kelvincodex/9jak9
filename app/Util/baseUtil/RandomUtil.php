<?php

namespace App\Util\baseUtil;

trait RandomUtil
{
    /**
     * @throws \Exception
     */
    public function OTP(): int
    {
        return random_int(100000,999999);
    }

    public function RANDOM_STRING($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }

    public function USERNAME($email): string
    {
        $emails = explode('@', $email);
        return $emails[0] . mt_rand(0, 9999);
    }
}
