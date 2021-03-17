<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(restaurateurs_seeder::class);
        $this->call(restaurant_seeder::class);
        $this->call(types_seeder::class);
        $this->call(restaurant_to_type_seeder::class);
        $this->call(genres_seeder::class);
        $this->call(dishes_seeder::class);
        $this->call(orders_seeder::class);
        $this->call(dishes_order_seeder::class);
    }
}
