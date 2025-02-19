<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('cargos')->insert([
            ['nome' => 'Desenvolvedor', 'descricao' => 'Responsável pelo desenvolvimento de software', 'status' => 'Ativo'],
            ['nome' => 'Analista de Sistemas', 'descricao' => 'Analisa e projeta soluções de TI', 'status' => 'Ativo'],
            ['nome' => 'Gerente de Projetos', 'descricao' => 'Gerencia projetos e equipes de TI', 'status' => 'Ativo'],
            ['nome' => 'Suporte Técnico', 'descricao' => 'Presta suporte a usuários e sistemas', 'status' => 'Ativo'],
        ]);
    }
}
