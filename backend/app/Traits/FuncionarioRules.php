<?php

namespace App\Traits;

use App\Models\Funcionario;
use App\Rules\CpfValidate;

trait FuncionarioRules
{
    // definição da regras de validação para o cadastro de funcionários
    public function storeRules(): array
    {
        return [
            'email' => 'required|email|unique:funcionarios,email',
            'cpf'   => ['required', 'unique:funcionarios,cpf', new CpfValidate()],
            'data_nascimento' => 'required',
            'data_admissao' => 'required',
            'salario' => 'required|numeric',
        ];
    }

    // definição da regras de validação para o cadastro de funcionários
    public function updateRules(Funcionario $funcionario): array
    {
        return [
            'email' => 'email|unique:funcionarios,email,' . $funcionario->id,
            'data_nascimento' => 'nullable|date', // Permite valor vazio
            'data_admissao' => 'nullable|date', // Permite valor vazio
            'salario' => 'numeric',
            'cpf' => ['unique:funcionarios,cpf,' . $funcionario->id, new CpfValidate()],
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
        ];
    }
}
