<?php


namespace HamidRoohani\TwoFactorAuth;


class TokenGenerator
{
    public function generateToken()
    {
        return random_int(100000,999999);
    }
}
