<?php


namespace TwoFactorAuth;


class TokenStore
{
    public function tokenStore($token, $user)
    {
        cache()->add($token . '_twoFactoAuth', $user->id);
    }
}
