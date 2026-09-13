<?php

namespace App\Providers;

use App\Models\Addon;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->singleton('settings', function () {
            return Cache::rememberForever('settings', function () {
                try {
                    return Schema::hasTable('settings') ? Setting::all() : collect();
                } catch (\Throwable $e) {
                    return collect();
                }
            });
        });
        $this->app->singleton('languages', function () {
            return Cache::rememberForever('languages', function () {
                try {
                    return Schema::hasTable('languages') ? Language::where('status', 1)->get() : collect();
                } catch (\Throwable $e) {
                    return collect();
                }
            });
        });
        $this->app->singleton('currencies', function () {
            return Cache::rememberForever('currencies', function () {
                try {
                    return Schema::hasTable('currencies') ? Currency::where('status', 1)->get() : collect();
                } catch (\Throwable $e) {
                    return collect();
                }
            });
        });
        $this->app->singleton('addons', function () {
            return Cache::rememberForever('addons', function () {
                try {
                    return Schema::hasTable('addons') ? Addon::where('status', 1)->get() : collect();
                } catch (\Throwable $e) {
                    return collect();
                }
            });
        });
		
        try {
            if(setting('current_version') == 140) {
                envWrite('APP_INSTALLED', true);
                envWrite('DEV_MODE', false);
                envWrite('DEMO_MODE', false);
            }

            if (setting('https')) {
                URL::forceScheme('https');
            }
        } catch (\Throwable $e) {
            // Database not connected yet
        }
    }
}
