<?php

namespace App\Models;

use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cargo extends Model
{
    //
    use HasFactory;

    protected $table = 'cargos';

    protected $fillable = [
        'nome',
        'descricao',
        'status',
    ];

    public function funcionarios()
    {
        return $this->hasMany(Funcionario::class, 'cargo_id');
    }
}
