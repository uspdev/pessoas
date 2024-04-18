<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // criando algumas permissões a serem utilizadas pela aplicação
       Permission::firstOrCreate(['name' => 'pessoas.basico']);
       Permission::firstOrCreate(['name' => 'pessoas.avancado']);
       Permission::firstOrCreate(['name' => 'pessoas.complementar']);

       // criando role e tribuindo permissões a ela
       $role = Role::firstOrCreate(['name' => 'pessoas']);
       $role->givePermissionTo(['pessoas.basico','pessoas.avancado','pessoas.complementar']);

       Permission::firstOrCreate(['name' => 'posgraduacao']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
