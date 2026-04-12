<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();


            $table->foreignId('propiedad_id')
                ->constrained('propiedades')
                ->onDelete('cascade');

            // Relación con el usuario
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->integer('rating');
            $table->text('comentario')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
