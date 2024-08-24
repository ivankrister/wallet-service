<?php

namespace DotcodeIo\Wallet\Providers;

use DotcodeIo\Wallet\Models\WalletModel;
use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        $this->app->singleton('wallet.model', function ($app) {
            return new WalletModel();
        });
    }
  
    public function boot(): void
    {
     
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->publishes([
            __DIR__.'/../Config/wallet.php' => config_path('wallet.php'),
        ], 'config');
    }
}
