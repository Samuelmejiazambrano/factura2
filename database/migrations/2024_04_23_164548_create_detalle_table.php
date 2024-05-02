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
        Schema::create('detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkProducto');
            $table->unsignedBigInteger('fkFactura');
            $table->string('nombre');
            $table->unsignedInteger('cantidad');
            $table->bigInteger('subTotal');
            $table->bigInteger('valor');
            $table->bigInteger('total');
            $table->timestamps();
        
            $table->foreign('fkFactura')->references('id')->on ('facturas');
            $table->foreign('fkProducto')->references('id')->on ('productos');
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('detalle');
    }
};
