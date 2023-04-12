<?php

namespace App\Providers;

use Spatie\Permission\Models\Role;
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

        Permission::firstOrCreate(['name' => 'pessoas.basico']);
        Permission::firstOrCreate(['name' => 'pessoas.avancado']);
        Permission::firstOrCreate(['name' => 'pessoas.complementar']);

        // criando role e tribuindo permissões a ela
        $role = Role::firstOrCreate(['name' => 'pessoas']);
        $role->givePermissionTo(['pessoas.basico','pessoas.avancado','pessoas.complementar']);

        Permission::firstOrCreate(['name' => 'graduacao']);
        Permission::firstOrCreate(['name' => 'posgraduacao']);
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
