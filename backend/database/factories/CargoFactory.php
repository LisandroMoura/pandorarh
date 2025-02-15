<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cargo>
 */
class CargoFactory extends Factory
{

    protected $model = Cargo::class;

    /**
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nome' => $this->faker->jobTitle(), // Gera um nome de cargo aleatório
            'descricao' => $this->faker->sentence(), // Gera uma descrição curta
            'status' => $this->faker->randomElement(['Ativo', 'Inativo']), // Status aleatório
        ];
    }
}
