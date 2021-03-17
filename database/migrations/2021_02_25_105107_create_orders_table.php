<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("total", 50);
            $table->string("client_name", 128);
            $table->string("client_surname", 128);
            $table->string("client_email", 128);
            $table->string("client_phone", 128);
            $table->string("client_address", 512);
            $table->boolean("is_payed");
            $table->unsignedBigInteger("restaurant_id");
            $table->foreign("restaurant_id")->references("id")->on("restaurants")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
