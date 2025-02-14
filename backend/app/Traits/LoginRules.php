<?php

namespace App\Traits;

trait LoginRules
{
    // definição da regras de validação para o cadastro e login de usuários
    public function loginRules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    // personalização das mensagens de validação
    // deixando mais claro para quem consumir a API as validações...
    public function loginMessages(): array
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'password.required' => 'A senha é obrigatória',
        ];
    }
}
