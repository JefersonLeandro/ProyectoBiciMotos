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
        Schema::create('DetallesFacturas', function (Blueprint $table) {
            $table->id('idDetalle');
            $table->integer('subTotalDetalle');
            $table->integer('cantidadDetalle');
            
             // Llave foránea
             $table->unsignedBigInteger('idProducto');
             $table->foreign('idProducto')->references('idProducto')->on('Productos');

              // Llave foránea
            $table->unsignedBigInteger('idFactura');
            $table->foreign('idFactura')->references('idFactura')->on('Facturas');

 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DetallesFacturas');
    }
};
