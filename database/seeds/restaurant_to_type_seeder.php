<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Type;
use App\Restaurant;
use Faker\Generator as Faker;
use Carbon\Carbon;
class restaurant_to_type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('restaurant_type')->insert([
            [
                'restaurant_id' => 1,
                'type_id' => 8
            ],
            [
                'restaurant_id' => 1,
                'type_id' => 1
            ],
            [
                'restaurant_id' => 2,
                'type_id' => 1
            ],
            [
                'restaurant_id' => 2,
                'type_id' => 4
            ],
            [
                'restaurant_id' => 2,
                'type_id' => 7
            ],
            [
                'restaurant_id' => 3,
                'type_id' => 6
            ],
            [
                'restaurant_id' => 3,
                'type_id' => 4
            ],
            [
                'restaurant_id' => 4,
                'type_id' => 3
            ],
            [
                'restaurant_id' => 4,
                'type_id' => 8
            ],
            [
                'restaurant_id' => 5,
                'type_id' => 2
            ],
            [
                'restaurant_id' => 5,
                'type_id' => 4
            ],
            [
                'restaurant_id' => 6,
                'type_id' => 12
            ],
            [
                'restaurant_id' => 6,
                'type_id' => 9
            ],
            [
                'restaurant_id' => 6,
                'type_id' => 11
            ],
            [
                'restaurant_id' => 6,
                'type_id' => 7
            ],
            [
                'restaurant_id' => 7,
                'type_id' => 10
            ],
            [
                'restaurant_id' => 8,
                'type_id' => 5
            ],
            [
                'restaurant_id' => 9,
                'type_id' => 1
            ],
            [
                'restaurant_id' => 9,
                'type_id' => 7
            ],
            [
                'restaurant_id' => 9,
                'type_id' => 4
            ],
            [
                'restaurant_id' => 9,
                'type_id' => 6
            ],
            [
                'restaurant_id' => 10,
                'type_id' => 11
            ],
            [
                'restaurant_id' => 10,
                'type_id' => 7
            ],
            [
                'restaurant_id' => 10,
                'type_id' => 6
            ],
            [
                'restaurant_id' => 10,
                'type_id' => 9
            ],
        ]);
    }
}
