<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

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
