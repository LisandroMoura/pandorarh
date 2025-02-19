<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cargo;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;


class FuncionarioTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar e autenticar o usuário
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    /**
     * A basic feature test example.
     */
    public function test_can_create_funcionario(): void
    {
        // buscar o primeiro cargo do sistema cadastrado
        $cargo = Cargo::factory()->create();

        // informar um possível novo funcionário
        $data = [
            "nome" => "Jsoé da Silva",
            "apelido" => "jose",
            "cpf" => "725.811.734-24",
            "rg" => "12.345.678-9",
            "data_nascimento" => "1990-05-15",
            "genero" => "Masculino",
            "estado_civil" => "Casado",
            "nome_pai" => "Carlos da Silva",
            "nome_mae" => "Maria da Silva",
            "telefone" => "+55 (11) 98765-4321",
            "email" => "testando@testando.com",
            "endereco" => "Rua das Flores, 123",
            "data_admissao" => "2020-03-10",
            "salario" => 5000.00,
            "status" => "Ativo",
            "cargo" => $cargo->id
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->createToken('TestToken')->plainTextToken
        ])->postJson('/api/funcionarios', $data);


        $response->assertStatus(201);

        $this->assertDatabaseHas('funcionarios', [
            'email' => 'testando@testando.com',
            'cpf' => '725.811.734-24',
        ]);
    }

    public function test_can_not_duplicate_cpf(): void
    {
        // criar um Funcionário Fake::Factory
        $funcionarioFAKE = Funcionario::factory()->create([
            'cpf' => '304.807.439-24',
        ]);

        // preparar os dados para o novo funcionário que vamos tentar criar
        // informando o MESMO CPF do anteriormente cadastrado
        $data = [
            "nome" => "Aldair pedro Jsoé da Silva",
            "apelido" => "adair",
            "cpf" => "304.807.439-24",
            "rg" => "12.345.678-9",
            "data_nascimento" => "1990-05-15",
            "genero" => "Feminino",
            "estado_civil" => "Casado",
            "nome_pai" => "Carlos da Silva",
            "nome_mae" => "Maria da Silva",
            "telefone" => "+55 (11) 98765-4321",
            "email" => "testando@testando.com",
            "endereco" => "Rua das Flores, 123",
            "cep" => "01234-567",
            "cidade" => "São Paulo",
            "estado" => "SP",
            "departamento" => "TI",
            "data_admissao" => "2020-03-10",
            "tipo_contrato" => "CLT",
            "salario" => 5000.00,
            "carga_horaria_semanal" => 40,
            "banco" => "Banco do Brasil",
            "agencia" => "1234-5",
            "conta" => "98765-4",
            "pis" => "123.45678.91-9",
            "ctps" => "12345/001",
            "data_rescisao" => null,
            "motivo_rescisao" => null,
            "status" => "Ativo",
            "cargo" => $funcionarioFAKE->cargo_id
        ];

        // executar
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->createToken('TestToken')->plainTextToken
        ])->postJson('/api/funcionarios', $data);


        // Assert: 422 (Unprocessable Entity)
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['cpf']);
    }
}
