<?php


namespace TwoFactorAuth\Http;


use Illuminate\Support\Facades\Facade;

class ResponderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twoFactorAuth.responder';
    }

    static function shouldProxyTo($class)
    {
        app()->singleton(self::getFacadeAccessor(),$class);
    }
}
