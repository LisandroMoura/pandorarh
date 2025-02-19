<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Facedes\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     *  testar o cadastro de usuário com dados válidos
     */
    public function test_if_user_can_login_with_valid_data(): void
    {
        // registrar usuário na base
        $response = $this->postJson('/api/register', [
            'name' => 'desafioTesteRegistro',
            'email' => 'desafioTesteRegistro@bruningsistemas.com.br',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        // testar se o usuário foi registrado com sucesso
        $response->assertStatus(201)
            ->assertJsonStructure(['token']);

        $this->assertDatabaseHas('users', [
            'email' => 'desafioTesteRegistro@bruningsistemas.com.br'
        ]);

        $response->assertStatus(201);
    }

    public function test_fail_register_user(): void
    {
        // Teste  de usuário com dados inválidos
        $response = $this->postJson('/api/register', [
            'email' => 'lisandro2-invalid-email', // informar email inválido para teste
            'password' => '', // informar password null para teste
            'password_confirmation' => ''
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }
}
