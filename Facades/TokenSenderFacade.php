<?php


namespace TwoFactorAuth\Facades;


use Illuminate\Support\Facades\Facade;

class TokenSenderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twoFactorAuth.tokenSender';
    }

    static function shouldProxyTo($class)
    {
        app()->singleton(self::getFacadeAccessor(),$class);
    }
}
