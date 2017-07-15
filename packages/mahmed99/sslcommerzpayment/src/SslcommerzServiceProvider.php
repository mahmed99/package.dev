<?php

namespace Mahmed99\Sslcommerzpayment;

use Illuminate\Support\ServiceProvider;
use Mahmed99\Sslcommerzpayment\Controllers\PaymentSuccessController;
use Mahmed99\Sslcommerzpayment\Controllers\PaymentFailedController;
use Mahmed99\Sslcommerzpayment\Controllers\PaymentCancelledController;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentSuccessRepository;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentFailedRepository;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentCancelledRepository;
use Mahmed99\Sslcommerzpayment\Repositories\PaymentRepositoryInterface;

class SslcommerzServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'sslcommerzpayment');

        $this->publishes([
            __DIR__.'/config/sslcommerzpayment.php' => config_path('sslcommerzpayment.php'),
        ]);

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/sslcommerzpayment'),
        ]);

        // $this->publishes([
        //     __DIR__.'/resources/assets' => public_path('vendor/sslcommerzpayment'),
        // ], 'public')        

    }
    
    public function register()
    {
        
        $this->mergeConfigFrom(
            __DIR__.'/config/sslcommerzpayment.php', 'sslcommerzpayment'
        );

        $this->app->when(PaymentSuccessController::class)
          ->needs(PaymentRepositoryInterface::class)
          ->give(PaymentSuccessRepository::class);

        $this->app->when(PaymentFailedController::class)
          ->needs(PaymentRepositoryInterface::class)
          ->give(PaymentFailedRepository::class);

        $this->app->when(PaymentCancelledController::class)
          ->needs(PaymentRepositoryInterface::class)
          ->give(PaymentCancelledRepository::class);
        
        //Facade binding
        // $this->app->singleton(SslcommerzPaymentInfo::class, function() {
        //     return new SslcommerzPaymentInfo();
        // });
        //$this->app->alias(SslcommerzPaymentInfo::class, 'sslcommerz');
        $this->app->singleton('sslcommerz', function() {
            return new SslcommerzPaymentInfo();
        });

    }
}
