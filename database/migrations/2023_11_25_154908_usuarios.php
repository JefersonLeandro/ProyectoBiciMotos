<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Usuarios', function (Blueprint $table) {

            $table->id('idUsuario');
            $table->string('nombreUsuario',60);
            $table->string('apellidoUsuario',60);
            $table->string('identificacionUsuario',12);
            $table->string('email')->unique();
            $table->string('password');

             // Llave foránea
            $table->unsignedBigInteger('idRol');//Llave foránea idRol local de esta tabla osea usuario, ejemplo (idRolUsuario)
            $table->foreign('idRol')->references('idRol')->on('Roles');

            // foreign : recibe idRol local osea la misma llave foranea que se crea en esta tabla con el  ejemplo seria la misma (idRolUsuario)
            // refenrences : nombre de la llave de la tabla padre en este caso el idRol de tabla Roles 
            // on : la tabla la cual va refenciar la llave foranea en este caso Roles 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuarios');
    }
};
