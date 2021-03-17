<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Illuminate\Support\Facades\DB;
class restaurant_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Restaurant::class, 10)->create();



        DB::table('restaurants')->insert( array(
            array(
                'name' => 'La Taverna di Gennaro',
                'address' => 'Via Garibaldi, 13, 38060 Villa Lagarina Italia',
                'p_iva' => '60028970626',
                'image_url' => 'pizzeria_da_gennaro.jpg',
                'restaurateur_id' => 1
            ),
            array(
                'name' => 'Osteria del Pettirosso',
                'address' => 'Corso Angelo Bettini 24, 38068, Rovereto Italia',
                'p_iva' => '27178340389',
                'image_url' => 'pizzeria_fratelli_vuolo.jpg',
                'restaurateur_id' => 2
            ),
            array(
                'name' => 'Bar Ristorante Pizzeria Alle Palme',
                'address' => 'Via Panizza, 56, 38060 Volano TN',
                'p_iva' => '68207150167',
                'image_url' => 'pizzeria_pepe_in_grani.jpg',
                'restaurateur_id' => 3
            ),
            array(
                'name' => 'Panificio Moderno',
                'address' => 'Viale Trento, 31/G 31/g, 38068, Rovereto Italia',
                'p_iva' => '40977430137',
                'image_url' => 'pizzeria_presidente.jpg',
                'restaurateur_id' => 4
            ),
            array(
                'name' => 'Kensho Restaurant',
                'address' => 'Via Mercanti, 16 Ex Mister Hu, 10122 Torino Italia',
                'p_iva' => '12962660226',
                'image_url' => 'kensho.jpg',
                'restaurateur_id' => 5
            ),
            array(
                'name' => "Maison du Brasil",
                'address' => 'Via Paolo Veronese n.240 TORINO, 10149 Torino Italia',
                'p_iva' => '47769490088',
                'image_url' => 'brasil.jpg',
                'restaurateur_id' => 6
            ),
            array(
                'name' => 'Pasticceria Venier',
                'address' => 'Via Monte di Pietà, 22/B, 10122 Torino Italia',
                'p_iva' => '10236140686',
                'image_url' => 'ghigo.webp',
                'restaurateur_id' => 7
            ),
            array(
                'name' => 'Lo Fai',
                'address' => 'Piazza Mario Springa 1, 38060 Nomi Italia',
                'p_iva' => '72729960624',
                'image_url' => 'vegan.jpg',
                'restaurateur_id' => 8
            ),
            array(
                'name' => 'Assaporando Trattoria',
                'address' => 'Piazza Valeriano Malfatti 8, 38068, Rovereto Italia',
                'p_iva' => '11765370504',
                'image_url' => 'Ristorante-Il-Doge-Camogli.jpg',
                'restaurateur_id' => 9
            ),
            array(
                'name' => 'The Burger Factory',
                'address' => 'Piazza San Vincenzo, 1, 38060 Isera Italia',
                'p_iva' => '52855690492',
                'image_url' => 'cucinoio.jpg',
                'restaurateur_id' => 10
            ),
        ));
    }
}
