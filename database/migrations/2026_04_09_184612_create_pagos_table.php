<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propiedad_id')->constrained('propiedades')->onDelete('cascade');
            $table->foreignId('user_id')->comment('ID del Inquilino')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('arrendador_id');
            $table->foreign('arrendador_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->decimal('monto', 10, 2);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            
            $table->string('stripe_id')->nullable();
            $table->string('status')->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};