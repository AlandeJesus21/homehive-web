<?php

namespace Database\Factories;

use App\Models\Propiedad;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends Factory<Propiedad>
 */
class PropiedadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

public function definition(): array
{
    return [
        'titulo' => $this->faker->sentence(3),
        'precio' => $this->faker->numberBetween(1500, 15000),
        'tipo' => $this->faker->randomElement(['casa', 'departamento', 'cuarto']),
        'calle' => $this->faker->streetName(),
        'latitud' => $this->faker->latitude(),
        'longitud' => $this->faker->longitude(),
        'forma_pago' => $this->faker->randomElement(['transferencia', 'efectivo']),
        'servicio' => $this->faker->randomElement(['agua', 'luz', 'gas', 'internet']),
        'descripcion' => $this->faker->paragraph(),
        'reglas' => $this->faker->sentence(),
        'cercanias' => $this->faker->sentence(),
        
        'user_id' => User::factory(),

        'barrio_id' => random_int(1, 10), // o random si tienes varios
    ];
}
}