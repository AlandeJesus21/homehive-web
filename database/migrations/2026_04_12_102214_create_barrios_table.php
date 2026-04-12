<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barrios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::table('propiedades', function (Blueprint $table) {
            $table->foreignId('barrio_id')
                  ->nullable()
                  ->constrained('barrios')
                  ->onDelete('set null');
        });

        DB::table('barrios')->insert([
            ['nombre' => 'Centro'],
            ['nombre' => 'Norte'],
            ['nombre' => 'Sur'],
            ['nombre' => 'Oriente'],
            ['nombre' => 'Poniente'],
            ['nombre' => 'Nuevo México'],
            ['nombre' => 'San Antonio'],
            ['nombre' => 'La Candelaria'],
            ['nombre' => 'Guadalupe'],
            ['nombre' => 'El Bosque'],
        ]);
    }

    public function down(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropForeign(['barrio_id']);
            $table->dropColumn('barrio_id');
        });

        Schema::dropIfExists('barrios');
    }
};
