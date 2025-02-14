<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\LoginRules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use LoginRules;

    /**
     * Metodo de validação das informações recebidas no request
     * Refatorar:
     * Fatarado o código para observas os princípios de DRY (Don't Repeat Yourself) e 
     * o princípio de Responsabilidade Única (SRP) do SOLID.
     * 
     * @param Request $request
     * @return boolean
     */
    private function validateRequest(Request $request): bool | JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            $this->loginRules(),
            $this->loginMessages()
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        return true;
    }

    /**
     * função responsável pelo cadastramento de usuários
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        // Validar os dados recebidos
        // Usando a Facedes Validator para maior controle das msgs de erro
        $validation = $this->validateRequest($request);
        if ($validation !== true) {
            return $validation;
        }

        // Criar um novo usuário
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // Retornar o token de autenticação
        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 201);
    }

    /**
     * metodo responsável por fazer o login do usuário
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        // Validar os dados recebidos
        $validation = $this->validateRequest($request);
        if ($validation !== true) {
            return $validation;
        }

        // Verificar se o usuário existe
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            // retornar o token de autenticação
            return response()->json([
                'token_type' => 'Bearer',
                'token' => $user->createToken('auth_token')->plainTextToken
            ], 201);
        }

        // retornar mensagem de erro
        return response()->json([
            'message' => "usuário não autorizado",
        ], 401);
    }
}
