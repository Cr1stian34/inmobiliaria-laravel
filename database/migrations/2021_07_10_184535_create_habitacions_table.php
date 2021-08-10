<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_habitacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });


        Schema::create('habitacions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->float('precio');
            $table->string('ubicacion');
            $table->string('callep');
            $table->string('contacto');
            $table->text('descripcion');
            $table->string('estado');
            $table->string('imagen');
            $table->foreignId('user_id')->references('id')->on('users')->comment('El usuario que creara la publicación');
            $table->foreignId('categoria_id')->index('id')->on('categoria_habitacions')->comment('La categoria del inmueble');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_habitacions');
        Schema::dropIfExists('habitacions');
    }
}
