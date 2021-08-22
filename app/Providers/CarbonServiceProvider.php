<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Morilog\Jalali\Jalalian;

class CarbonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Carbon::setLocale('fa_IR');

        Carbon::macro('formatJalali', function ($format='Y/n/j') {
            return Jalalian::fromCarbon(self::this())->format($format);
        });
        Carbon::macro('fromJalali', function ($value, $format='Y/n/j') {
            return Jalalian::fromFormat($format, $value)->toCarbon();
        });
    }
}
