<?php

use App\Dish;
use App\Order;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class dishes_order_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $dishes = Dish::all();
        $orders = Order::all();

        foreach ($orders as $order) {
            for ($i = 1; $i <= $faker->numberBetween(1, count($dishes)); $i++) {

                DB::table("dish_order")->insert([
                    "order_id" => $order->id,
                    "dish_id" => $i,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

                ]);
            }
        }
    }
}
