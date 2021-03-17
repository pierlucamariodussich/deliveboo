<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurateurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name",128);
            $table->string("surname",128);
            $table->string("email",128)->unique();
            $table->string("password",128);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurateurs');
    }
}
