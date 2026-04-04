<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();

            
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            
            $table->string('titulo');
            $table->string('tipo'); 
            $table->string('calle');

            
            $table->decimal('latitud', 10, 8);
            $table->decimal('longitud', 11, 8);

            
            $table->decimal('precio', 10, 2);
            $table->string('forma_pago');
            $table->text('servicio')->nullable(); 

            
            $table->text('descripcion');
            $table->text('reglas');
            $table->string('cercanias'); 

            
            $table->string('imagen')->nullable();

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        
        Schema::dropIfExists('propiedades');
    }
};