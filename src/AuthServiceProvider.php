<?php

namespace Sandrocagara\Multiauth;

use Illuminate\Support\ServiceProvider; 

class AuthServiceProvider extends ServiceProvider 
{
    public function boot()  
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->mergeConfigFrom(__DIR__. '/config/auth.php','multiauth');
        $this->mergeConfigFrom(__DIR__. '/config/mail.php','multiauth');
        $this->publishes([
            __DIR__.'/config/auth.php' => config_path('auth.php'),
            __DIR__.'/config/mail.php' => config_path('mail.php'),
            __DIR__.'/views' => resource_path('/views'),
            __DIR__.'/database/migrations/' => database_path('/migrations'),
            __DIR__.'/database/factories/' => database_path('/factories'),
            __DIR__.'/Http/Controllers' => app_path('/Http/Controllers'),
            __DIR__.'/Http/Middleware' => app_path('/Http/Middleware'),
            __DIR__.'/Models' => app_path('./'),
            __DIR__.'/Notifications' => app_path('/Notifications'),
            __DIR__.'/Providers' => app_path('/Providers'),
        ]);
    }

    public function register() 
    {

    }
}