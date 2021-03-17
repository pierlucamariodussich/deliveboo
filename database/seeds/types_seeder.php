<?php

use Illuminate\Database\Seeder;
use App\Type;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class types_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
            DB::table("types")->insert([

                [
                    'id' => 1,
                    'name' => 'Italiano',
                    'image_url' => 'img/homepage/icon/Italiano.png'
                ],
                [
                    'id' => 2,
                    'name' => 'Orientale',
                    'image_url' => 'img/homepage/icon/Orientale.png'
                ],
                [
                    'id' => 3,
                    'name' => 'Pane',
                    'image_url' => 'img/homepage/icon/Pane.png'
                ],
                [
                    'id' => 4,
                    'name' => 'Pesce',
                    'image_url' => 'img/homepage/icon/Pesce.png'
                ],
                [
                    'id' => 5,
                    'name' => 'Vegan',
                    'image_url' => 'img/homepage/icon/Vegan.png'
                ],
                [
                    'id' => 6,
                    'name' => 'Fritto',
                    'image_url' => 'img/homepage/icon/Fritto.png'
                ],
                [
                    'id' => 7,
                    'name' => 'Carne',
                    'image_url' => 'img/homepage/icon/Carne.png'
                ],
                [
                    'id' => 8,
                    'name' => 'Pizza',
                    'image_url' => 'img/homepage/icon/Pizza.png'
                ],
                [
                    'id' => 9,
                    'name' => 'BBQ',
                    'image_url' => 'img/homepage/icon/Bbq.png'
                ],
                [
                    'id' => 10,
                    'name' => 'Dolci',
                    'image_url' => 'img/homepage/icon/Dessert.png'
                ],
                [
                    'id' => 11,
                    'name' => 'Burger',
                    'image_url' => 'img/homepage/icon/Burger.png'
                ],
                [
                    'id' => 12,
                    'name' => 'Brasiliano',
                    'image_url' => 'img/homepage/icon/Brasiliano.png'
                ],
            ]);  
    }
            
}
