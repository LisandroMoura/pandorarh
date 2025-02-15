<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('apelido', 150)->nullable();
            $table->char('cpf', 11)->unique();
            $table->string('rg', 20)->nullable();
            $table->date('data_nascimento');
            $table->enum('genero', ['Masculino', 'Feminino', 'Não informado'])->default('Não informado');
            $table->enum('estado_civil', ['Solteiro', 'Casado', 'Divorciado', 'Viúvo', 'Separado', 'União Estável'])->default('Solteiro');
            $table->string('nome_pai', 150)->nullable();
            $table->string('nome_mae', 150)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 150)->unique()->nullable();
            $table->text('endereco')->nullable();
            $table->char('cep', 8)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->char('estado', 2)->nullable();
            $table->string('departamento', 100)->nullable();
            $table->date('data_admissao');
            $table->enum('tipo_contrato', ['CLT', 'PJ', 'Estágio', 'Autônomo', 'Temporário'])->default('CLT');
            $table->decimal('salario', 10, 2);
            $table->integer('carga_horaria_semanal')->default(40);
            $table->string('banco', 100)->nullable();
            $table->string('agencia', 10)->nullable();
            $table->string('conta', 20)->nullable();
            $table->char('pis', 11)->unique()->nullable();
            $table->string('ctps', 20)->unique()->nullable();
            $table->date('data_rescisao')->nullable();
            $table->text('motivo_rescisao')->nullable();
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');

            // relacionamento com a tabela de cargos
            $table->unsignedBigInteger('cargo_id')->after('estado')->nullable();
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            $table->dropForeign(['cargo_id']);
            $table->dropColumn('cargo_id');
        });
        Schema::dropIfExists('funcionarios');
    }
};
