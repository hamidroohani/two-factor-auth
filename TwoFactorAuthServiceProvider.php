<?php


namespace TwoFactorAuth;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use TwoFactorAuth\Authenticator\SessionAuth;
use TwoFactorAuth\Facades\AuthFacade;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;
use TwoFactorAuth\Http\ResponderFacade;
use TwoFactorAuth\Http\Responses\AndroidResponses;

class TwoFactorAuthServiceProvider extends ServiceProvider
{
    private $namespace = "TwoFactorAuth\Http\Controllers";

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
