<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("restaurant_id");
            $table->foreign("restaurant_id")->references("id")->on("restaurants");
            $table->unsignedBigInteger("genre_id");
            $table->foreign("genre_id")->references("id")->on("genres")->onDelete('cascade');
            $table->string("name", 128);
            $table->string("price",50);
            $table->boolean("visibility",true);
            $table->text("description");
            $table->string("image_url",512);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
