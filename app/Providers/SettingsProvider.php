<?php

namespace App\Providers;
use App\Models\Settings;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
   public function boot(): void
{
    if (app()->runningInConsole()) {
        // Skip DB queries when running artisan commands like config:cache
        return;
    }

    try {
        // Optionally check if settings table exists to avoid crash on fresh installs
        if (Schema::hasTable('settings')) {
            $main_settings = Settings::all()->pluck('value', 'key')->toArray();
            View::share('main_settings', $main_settings);
        }
    } catch (\Exception $e) {
        \Log::error('Failed to load settings: ' . $e->getMessage());
    }
}
}


// <?php

// namespace App\Providers;
// use App\Models\Settings;

// use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\View;

// class SettingsProvider extends ServiceProvider
// {
//     /**
//      * Register services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap services.
//      */
//     public function boot(): void
//     {
//         $main_settings = Settings::all()->pluck('value','key')->toArray();
//         View::share('main_settings',$main_settings);
//     }
// }