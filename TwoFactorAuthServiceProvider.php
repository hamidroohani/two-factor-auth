<?php


namespace TwoFactorAuth;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TwoFactorAuthServiceProvider extends ServiceProvider
{
    private $namespace = "TwoFactorAuth\Http\Controllers";

    public function register()
    {

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
