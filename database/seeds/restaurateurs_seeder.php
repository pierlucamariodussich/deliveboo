<?php

use Illuminate\Database\Seeder;
use App\Restaurateur;
class restaurateurs_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Restaurateur::class,10)->create();
    }
}
