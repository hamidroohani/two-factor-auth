<?php


namespace TwoFactorAuth\Authenticator;


use Illuminate\Support\Facades\Auth;

class SessionAuth
{
    public function check()
    {
        return Auth::check();
    }
}
