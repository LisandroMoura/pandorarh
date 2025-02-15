<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Busca um cargo existente
        $cargo = DB::table('cargos')->where('nome', 'Desenvolvedor')->first();

        if ($cargo) {
            DB::table('funcionarios')->insert([
                [
                    'nome' => 'Lisandro Moura Severino',
                    'apelido' => 'Lizi',
                    'cpf' => '12345678901', // unic
                    'data_nascimento' => '1978-08-11',
                    'genero' => 'Masculino',
                    'estado_civil' => 'Casado',
                    'nome_pai' => 'Jorge Santos',
                    'nome_mae' => 'Maria Eli Moura Ignácio',
                    // TODO: normalizar Endereço
                    'telefone' => '(48) 98829-5059',
                    'email' => 'lisandroprogramador@gmail.com', // unic
                    'endereco' => 'Rua irmã de Bittencourt, 238/304',
                    'cep' => '88708-493',
                    'cidade' => 'Tubarão',
                    'estado' => 'SC',
                    'cargo_id' => $cargo->id,
                    'departamento' => 'TI',
                    'data_admissao' => now(),
                    'tipo_contrato' => 'CLT',
                    'carga_horaria_semanal' => 40,
                    'pis' => '12345678900', // unic
                    'ctps' => '1234567', // unic
                    'data_rescisao' => null,
                    'motivo_rescisao' => null,
                    'status' => 'Ativo',
                    // dados sensíveis
                    'salario' => 1000.00,
                    'banco' => 'Banco do Brasil',
                    'agencia' => '1234',
                    'conta' => '56789-0',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
