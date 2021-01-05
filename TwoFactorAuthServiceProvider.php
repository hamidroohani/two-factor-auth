<?php


namespace HamidRoohani\TwoFactorAuth;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use HamidRoohani\TwoFactorAuth\Authenticator\SessionAuth;
use HamidRoohani\TwoFactorAuth\Facades\AuthFacade;
use HamidRoohani\TwoFactorAuth\Facades\TokenGeneratorFacade;
use HamidRoohani\TwoFactorAuth\Facades\TokenStoreFacade;
use HamidRoohani\TwoFactorAuth\Facades\UserProviderFacade;
use HamidRoohani\TwoFactorAuth\Http\ResponderFacade;
use HamidRoohani\TwoFactorAuth\Http\Responses\AndroidResponses;

class TwoFactorAuthServiceProvider extends ServiceProvider
{
    private $namespace = "HamidRoohani\TwoFactorAuth\Http\Controllers";

    public function register()
    {
        UserProviderFacade::shouldProxyTo(UserProvider::class);
        TokenStoreFacade::shouldProxyTo(TokenStore::class);
        TokenGeneratorFacade::shouldProxyTo(TokenGenerator::class);
        ResponderFacade::shouldProxyTo(AndroidResponses::class);
        AuthFacade::shouldProxyTo(SessionAuth::class);
    }

    public function boot()
    {
        $this->defineRoutes();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function defineRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/routes.php');
    }
}
