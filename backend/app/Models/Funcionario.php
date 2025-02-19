<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Funcionario extends Model
{
    //
    use HasFactory;

    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'apelido',
        'cpf',
        'rg',
        'data_nascimento',
        'genero',
        'estado_civil',
        'nome_pai',
        'nome_mae',
        'telefone',
        'email',
        'endereco',
        'data_admissao',
        'salario',
        'status',

        // TODO: campos que podem ser adicionados futuramente
        // 'cep',
        // 'cidade',
        // 'estado',
        // 'cargo_id',
        // 'departamento',
        // 'tipo_contrato',
        // 'carga_horaria_semanal',
        // 'banco',
        // 'agencia',
        // 'conta',
        // 'pis',
        // 'ctps',
        // 'data_rescisao',
        // 'motivo_rescisao',
    ];

    protected $hidden = [];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
        'salario' => 'decimal:2',
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}
