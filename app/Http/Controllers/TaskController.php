<?php

namespace App\Http\Controllers;

use App\Exceptions\TaskNotFound;
use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTask;
use App\Models\Task;
use App\Utils\ResponseUtils;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TaskController extends Controller
{
    /**
     * Lista todas as tarefas.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            // Busca todas as tasks
            $tasks = Task::all();

            // Valida se existem tasks
            ResponseUtils::checkTaskArray($tasks);

            // Retorna as tasks
            return ResponseUtils::successResponse($tasks, 200);
        } catch (TaskNotFound $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 500);
        }
    }

    /**
     * Cria uma nova tarefa.
     * @param CreateTask $request
     * @return JsonResponse
     */
    public function store(CreateTask $request): JsonResponse
    {
        try {
            // Valida os dados recebidos
            $validated = $request->validated();

            // Cria a task
            $task = Task::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);

            // Retorna a task
            return ResponseUtils::successResponse($task, 200);
        } catch (\Exception $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 500);
        }
    }

    /**
     * Recupera uma tarefa específica.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            // Busca uma task com o id informado
            $task = Task::find($id);

            // Valida se a task existe
            ResponseUtils::checkTask($task);

            // Retorna a task
            return ResponseUtils::successResponse($task, 200);
        } catch (TaskNotFound $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 500);
        }
    }

    /**
     * Atualiza uma tarefa específica.
     * @param UpdateTask $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateTask $request, string $id): JsonResponse
    {
        try {
            // Busca uma task com o id informado
            $task = Task::find($id);

            // Valida se a task existe
            ResponseUtils::checkTask($task);

            // Atualiza os dados da task
            $task->update($request->validated());

            // Retorna a task
            return ResponseUtils::successResponse($task, 200);
        } catch (TaskNotFound $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 500);
        }
    }

    /**
     * Remove uma task específica.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            // Busca uma task com o id informado
            $task = Task::find($id);

            // Valida se a task existe
            ResponseUtils::checkTask($task);

            // Remove a task
            $task->delete();

            // Retorna uma mensagem de sucesso
            return ResponseUtils::successResponse("Tarefa deletada com sucesso!", 200);
        } catch (TaskNotFound $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::errorResponse($ex->getMessage(), 500);
        }
    }
}
