<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void//crear y modificar
    {
        Schema::create('Roles', function (Blueprint $table) {
            $table->id('idRol');
            $table->string('nombreRol', 45);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void//Eliminar y deshacer
    {
        Schema::dropIfExists('Roles');
    }
};
