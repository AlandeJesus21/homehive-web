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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('propiedad_id')->nullable()->constrained('propiedades')->onDelete('cascade');
            
            // Datos de la Solicitud
            $table->string('propiedad'); // Nombre/Título de la propiedad al momento de solicitar
            $table->decimal('precio', 10, 2);
            $table->string('estatus')->default('Pendiente');
            $table->string('curp', 18);
            $table->integer('edad');
            $table->string('ocupacion');
            $table->date('fecha');
            $table->string('telefono');
            $table->text('mensaje')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};