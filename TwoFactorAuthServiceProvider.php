<?php


namespace TwoFactorAuth;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use TwoFactorAuth\Facades\TokenGeneratorFacade;
use TwoFactorAuth\Facades\TokenStoreFacade;
use TwoFactorAuth\Facades\UserProviderFacade;

class TwoFactorAuthServiceProvider extends ServiceProvider
{
    private $namespace = "TwoFactorAuth\Http\Controllers";

    public function register()
    {
        UserProviderFacade::shouldProxyTo(UserProvider::class);
        TokenStoreFacade::shouldProxyTo(TokenStore::class);
        TokenGeneratorFacade::shouldProxyTo(TokenGenerator::class);
    }

    public function boot()
    {
        $this->defineRoutes();
    }

    public function defineRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/routes.php');
    }
}
