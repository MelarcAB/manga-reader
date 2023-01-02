<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSuscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_suscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); // ID del usuario que realiza la suscripción
            $table->unsignedBigInteger('serie_id'); // ID de la serie a la que se suscribe el usuario
            $table->timestamps();

            // Clave foránea que relaciona la tabla de suscripciones con la tabla de usuarios
            $table->foreign('user_id')->references('id')->on('users');
            // Clave foránea que relaciona la tabla de suscripciones con la tabla de series
            $table->foreign('serie_id')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_suscriptions');
    }
}
