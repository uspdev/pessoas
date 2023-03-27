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

        Permission::firstOrCreate(['guard_name' => 'app', 'name' => 'pessoas.basico']);
        Permission::firstOrCreate(['guard_name' => 'app', 'name' => 'pessoas.avancado']);
        Permission::firstOrCreate(['guard_name' => 'app', 'name' => 'pessoas.complementar']);

        // criando role e tribuindo permissões a ela
        $role = Role::firstOrCreate(['guard_name' => 'app', 'name' => 'pessoas']);
        $role->givePermissionTo(['pessoas.basico','pessoas.avancado','pessoas.complementar']);

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
