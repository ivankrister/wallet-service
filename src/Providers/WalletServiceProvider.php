<?php

namespace DotcodeIo\Wallet\Providers;

use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
    }
  
    public function boot(): void
    {
     
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }
}
