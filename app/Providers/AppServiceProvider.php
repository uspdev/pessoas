<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // mariadb suport
        Schema::defaultStringLength(191);

        Permission::firstOrCreate(['guard_name' => 'app', 'name' => 'pessoas']);
        Permission::firstOrCreate(['guard_name' => 'app', 'name' => 'graduacao']);
        Permission::firstOrCreate(['guard_name' => 'app', 'name' => 'posgraduacao']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
