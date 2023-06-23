<?php

use App\Http\Controllers\AuthController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Gera um token JWT para o usuário de teste.
     * @param User $user
     * @return string|false
     */
    private function generateJwtToken($user): bool|string
    {
        // Credenciais de teste
        $credentials = ['email' => $user->email,'password' => '1liber2fly3'];

        // Tenta autenticar o usuário
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao criar o token'], 500);
        }

        // Retorna o token JWT
        return $token;
    }

    /**
     * Teste de autorização para acesso às rotas protegidas.
     *
     * @return void
     */
    public function testProtectedRoutes(): void
    {
        // Faz uma requisição GET para a rota '/api/task'
        $response = $this->getJson('/api/task');

        // Verifica se a resposta retorna um estado 401 (não autorizado)
        $response->assertStatus(401);
    }

    /**
     * Teste de listagem de tarefas
     * @return void
     */
    public function testIndex(): void
    {
        // Cria um usuário de teste
        $user = User::factory()->create([
            'email' => 'liberfly@test.com',
            'password' => Hash::make('1liber2fly3'),
        ]);

        // Gera um token JWT para o usuário de teste
        $token = $this->generateJwtToken($user);

        // Cria algumas tarefas para testar
        Task::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/task');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data',
        ]);

        $responseData = $response->json();
        $this->assertEquals('Success', $responseData['status']);

        // Verifica se os dados das tarefas foram retornados corretamente
        $this->assertArrayHasKey('data', $responseData);
        $this->assertCount(3, $responseData['data']);
    }

    /**
     * Teste de criação de tarefa.
     *
     * @return void
     */
    public function testCreateTask(): void
    {
        // Cria um usuário de teste
        $user = User::factory()->create([
            'email' => 'liberfly@test.com',
            'password' => Hash::make('1liber2fly3'),
        ]);

        // Gera um token JWT para o usuário de teste
        $token = $this->generateJwtToken($user);

        // Dados da nova tarefa
        $data = [
            'title' => 'Nova Tarefa',
            'description' => 'Descrição da nova tarefa',
        ];

        // Faz uma requisição POST para a rota '/api/task' com o token JWT
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/task', $data);

        // Verifica se a resposta retorna um estado 201 (criado) e se os dados da tarefa estão corretos
        $response->assertStatus(201)
            ->assertJson([
                'status' => 'Success',
                'data' => [
                    'title' => 'Nova Tarefa',
                    'description' => 'Descrição da nova tarefa',
                ],
            ]);
    }

    /**
     * Teste de leitura de tarefa.
     *
     * @return void
     */
    public function testReadTask()
    {
        // Cria um usuário de teste
        $user = User::factory()->create([
            'email' => 'liberfly@test.com',
            'password' => Hash::make('1liber2fly3'),
        ]);

        // Cria uma tarefa de teste
        $task = Task::factory()->create();

        // Gera um token JWT para o usuário de teste
        $token = $this->generateJwtToken($user);

        // Faz uma requisição GET para a rota '/api/task/{id}' com o token JWT
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/task/' . $task->id);

        // Verifica se a resposta retorna um estado 200 e se os dados da tarefa estão corretos
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'Success',
                'data' => [
                    'title' => 'Testar Aplicação',
                    'description' => 'Garantir que a aplicação funciona corretamente',
                ],
            ]);
    }

    /**
     * Teste de atualização de tarefa.
     *
     * @return void
     */
    public function testUpdateTask()
    {
        // Cria um usuário de teste
        $user = User::factory()->create([
            'email' => 'liberfly@test.com',
            'password' => Hash::make('1liber2fly3'),
        ]);

        // Cria uma tarefa de teste para o usuário
        $task = Task::factory()->create();

        // Gera um token JWT para o usuário de teste
        $token = $this->generateJwtToken($user);

        // Dados atualizados da tarefa
        $data = [
            'title' => 'Tarefa Atualizada',
            'description' => 'Descrição atualizada da tarefa',
            'status' => 'completed',
        ];

        // Faz uma requisição PUT para a rota '/api/task/{id}' com o token JWT
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->putJson('/api/task/' . $task->id, $data);

        // Verifica se a resposta retorna um estado 200 e se os dados da tarefa foram atualizados corretamente
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'Success',
                'data' => [
                    'title' => 'Tarefa Atualizada',
                    'description' => 'Descrição atualizada da tarefa',
                    'status' => 'completed',
                ],
            ]);
    }

    /**
     * Teste de exclusão de tarefa.
     *
     * @return void
     */
    public function testDeleteTask()
    {
        // Cria um usuário de teste
        $user = User::factory()->create([
            'email' => 'liberfly@test.com',
            'password' => Hash::make('1liber2fly3'),
        ]);

        // Cria uma tarefa de teste para o usuário
        $task = Task::factory()->create();

        // Gera um token JWT para o usuário de teste
        $token = $this->generateJwtToken($user);

        // Faz uma requisição DELETE para a rota '/api/task/{id}' com o token JWT
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->deleteJson('/api/task/' . $task->id);

        // Verifica se a resposta retorna um estado 200 de sucesso na exclusão
        $response->assertStatus(200);
    }
}
