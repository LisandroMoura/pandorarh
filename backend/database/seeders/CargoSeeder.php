<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('cargos')->insert([
            [
                'nome' => 'Desenvolvedor PHP',
                'descricao' => 'Desenvolvedor PHP para a empresa Desafio Bruning',
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('cargos')->insert([
            [
                'nome' => 'Front-end',
                'descricao' => 'Desenvolvedor Front-end para a empresa Desafio Bruning',
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('cargos')->insert([
            [
                'nome' => 'Designer',
                'descricao' => 'Designer gráfico para a empresa Desafio Bruning',
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('cargos')->insert([
            [
                'nome' => 'Gerente de Projetos',
                'descricao' => 'Gerente de Projetos para a empresa Desafio Bruning',
                'status' => 'Ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
