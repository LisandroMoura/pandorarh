<?php

namespace App\Traits;

use App\Models\Funcionario;
use App\Rules\CpfValidate;
use App\Rules\StatusValidate;
use App\Rules\DataNascimentoValidate;

trait FuncionarioRules
{
    // definição da regras de validação para o cadastro de funcionários
    public function storeRules(): array
    {
        return [
            'email' => 'required|email|unique:funcionarios,email',
            'cpf'   => ['required', 'unique:funcionarios,cpf', new CpfValidate()],
            'data_nascimento' => ['required', new DataNascimentoValidate],
            'data_admissao' => 'required',
            'salario' => 'required|numeric',
            // 'pis' => 'unique:funcionarios,pis',
            // 'ctps' => 'unique:funcionarios,ctps',
            'status' => ['required', new StatusValidate],
        ];
    }

    // definição da regras de validação para o cadastro de funcionários
    public function updateRules(Funcionario $funcionario): array
    {
        return [
            'email' => 'email|unique:funcionarios,email,' . $funcionario->id,
            'data_admissao' => 'date',
            'data_nascimento' => ['date', new DataNascimentoValidate],
            'salario' => 'numeric',
            'cpf' => ['unique:funcionarios,cpf,' . $funcionario->id, new CpfValidate()],
            'status' => [new StatusValidate],
            //'pis' => 'unique:funcionarios,pis,' . $funcionario->id,
            //'ctps' => 'unique:funcionarios,ctps,' . $funcionario->id,
        ];
    }

    // personalização das mensagens de validação
    // deixando mais claro para quem consumir a API  suas validações...
    public function messages(): array
    {
        return [
            'email.unique' => 'Email já cadastrado',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'data_nascimento.required' => "A data de nascimento é obrigatória",
            'data_admissao.required' => "A data de admissão é obrigatória",
            'salario.required' => "O salário deve ser informado",
            'salario.numeric' => "O salário deve ter um valor numérico",
            'cpf.unique' => 'Cpf já cadastrado',
            'cpf.required' => 'Cpf deve ser informado',
            // 'pis.unique' => 'Pis já cadastrado',
            // 'ctps.unique' => 'Ctps já cadastrada',
        ];
    }
}
