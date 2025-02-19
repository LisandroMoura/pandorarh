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
        $cargo = DB::table('cargos')->where('nome', 'Desenvolvedor PHP')->first();

        if ($cargo) {
            DB::table('funcionarios')->insert([
                [
                    'nome' => 'Desafio Bruning',
                    'apelido' => 'bruning',
                    'cpf' => '92197043072', // unic
                    'rg' => '1063026559',
                    'data_nascimento' => '1978-08-11',
                    'genero' => 'Masculino',
                    'nome_pai' => 'Jhon Snow',
                    'nome_mae' => 'Daenerys Targaryen',
                    'telefone' => '(48) 98829-5059',
                    'email' => 'desafio@bruningsistemas.com.br', // unic
                    'endereco' => 'Rua irmã de Bittencourt, 238/304',
                    'status' => 'Ativo',
                    'salario' => 1518.01,
                    'data_admissao' => now(),
                    'cargo_id' => $cargo->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('funcionarios')->insert([
                [
                    'nome' => 'Teste Bruning',
                    'apelido' => 'bruning',
                    'cpf' => '48909737107', // unic
                    'rg' => '7063026558',
                    'data_nascimento' => '1978-08-11',
                    'genero' => 'Masculino',
                    'nome_pai' => 'Jhon Snow',
                    'nome_mae' => 'Daenerys Targaryen',
                    'telefone' => '(48) 98829-5059',
                    'email' => 'teste@bruningsistemas.com.br', // unic
                    'endereco' => 'Rua irmã de Bittencourt, 238/304',
                    'status' => 'Ativo',
                    'salario' => 1518.01,
                    'data_admissao' => now(),
                    'cargo_id' => $cargo->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
