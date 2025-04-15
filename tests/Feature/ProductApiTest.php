<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    protected string $token;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria usuário admin e gera token
        $user = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        $this->token = JWTAuth::fromUser($user);
    }

    /** @test */
    public function test_cria_produto_com_dados_validos()
    {
        $category = Category::factory()->create();

        $payload = [
            'name' => 'Produto Teste',
            'description' => 'Descrição do produto',
            'quantity' => 10,
            'price' => 99.90,
            'sku' => 'TESTE-001',
            'category_id' => $category->id,
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/v1/products', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Produto Teste']);
    }

    /** @test */
    public function test_falha_ao_criar_produto_sem_token()
    {
        $response = $this->postJson('/api/v1/products', []);

        $response->assertStatus(401);
    }

    /** @test */
    public function test_falha_com_payload_invalido()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/v1/products', [
                             'name' => '', // obrigatório
                             'price' => -10, // inválido
                         ]);

        $response->assertStatus(422); // Unprocessable Entity
    }
}
