<?php


namespace TwoFactorAuth;


class TokenStore
{
    public function tokenStore($token, $userId)
    {
        cache()->add($token . '_twoFactoAuth', $userId);
    }
}
