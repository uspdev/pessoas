<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class CamposExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CamposExtras::class, 100)->create();
    }
}
