<?php


namespace TwoFactorAuth\Facades;


use Illuminate\Support\Facades\Facade;

class AuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twoFactorAuth.auth';
    }

    static function shouldProxyTo($class)
    {
        app()->singleton(self::getFacadeAccessor(),$class);
    }
}
