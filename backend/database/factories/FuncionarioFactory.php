<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'), // Gera um CPF fictício
            'data_nascimento' => $this->faker->date('Y-m-d', '-18 years'), // Pelo menos 18 anos
            'data_admissao' => $this->faker->date('Y-m-d'),
            'salario' => $this->faker->randomFloat(2, 1518.01, 1519),
            'cargo_id' => Cargo::factory(),
            'status' => $this->faker->randomElement(['Ativo', 'Inativo']),
            'genero' => $this->faker->randomElement(['Masculino', 'Feminino', 'Não informado']),
            'nome_mae' => $this->faker->name(),
            'nome_pai' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->faker->phoneNumber(),
            'endereco' => $this->faker->address(),
        ];
    }
}
