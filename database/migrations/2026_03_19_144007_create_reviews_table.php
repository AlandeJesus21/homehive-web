<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('propiedad_id');
        $table->unsignedBigInteger('user_id')->nullable(); // opcional
        $table->tinyInteger('rating'); // 1 a 5 estrellas
        $table->text('comentario')->nullable();
        $table->timestamps();

        $table->foreign('propiedad_id')->references('id')->on('propiedades')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};