<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));

        Model::preventLazyLoading();

        Password::defaults(function () {
            $rule = Password::min(8)->mixedCase()->numbers()->symbols()->max(40)->uncompromised();
            return $this->app->isProduction() ? $rule : Password::min(8);
        });
    }
}
