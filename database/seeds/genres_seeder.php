<?php

use Illuminate\Database\Seeder;
use App\Type;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class genres_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = ["antipasti", "primi", "carne", "pesce", "panini", "contorni", "dolci", "bevande", "amari",];

            DB::table("genres")->insert([
                // "name" => $genre, 
                // "image_url" => "slug_prova", 
                // 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                // 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

                [
                    'name' => 'Antipasti',
                    'image_url' => 'img/icon_genre/pane.png'
                ],
                [
                    'name' => 'Primi',
                    'image_url' => 'img/icon_genre/primi.png'
                ],
                [
                    'name' => 'Pizza',
                    'image_url' => 'img/icon_genre/pizze.png'
                ],
                [
                    'name' => 'Carne',
                    'image_url' => 'img/icon_genre/carne.png'
                ],
                [
                    'name' => 'Pesce',
                    'image_url' => 'img/icon_genre/pesce.png'
                ],
                [
                    'name' => 'Panini',
                    'image_url' => 'img/icon_genre/panini.png'
                ],
                [
                    'name' => 'Contorni',
                    'image_url' => 'img/icon_genre/contorni.png'
                ],
                [
                    'name' => 'Fritti',
                    'image_url' => 'img/icon_genre/fritti.png'
                ],
                [
                    'name' => 'Dessert',
                    'image_url' => 'img/icon_genre/dessert.png'
                ],
                [
                    'name' => 'Bevande',
                    'image_url' => 'img/icon_genre/bevande.png'
                ],
                [
                    'name' => 'Amari',
                    'image_url' => 'img/icon_genre/amari.png'
                ],
                [
                    'name' => 'Cocktail',
                    'image_url' => 'img/icon_genre/cocktail.png'
                ],
            ]);
    }
}
