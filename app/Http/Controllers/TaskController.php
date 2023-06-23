<?php

namespace App\Http\Controllers;

use App\Exceptions\TaskNotFoundException;
use App\Http\Requests\CreateTask;
use App\Http\Requests\UpdateTask;
use App\Models\Task;
use App\Utils\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Lista todas as tarefas caso existam.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $tasks = Task::all();

            ResponseUtils::checkTaskArray($tasks);

            return ResponseUtils::response('Success', $tasks, 200);
        } catch (TaskNotFoundException $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 500);
        }
    }

    /**
     * Válida os parâmetros passados e cria uma tarefa retornando o objeto criado.
     * @param CreateTask $request // Request personalizado para validação
     * @return JsonResponse
     */
    public function store(CreateTask $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $task = Task::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
            ]);

            return ResponseUtils::response('Success', $task, 200);
        } catch (\Exception $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 500);
        }
    }

    /**
     * Recupera uma tarefa específica caso exista.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $task = Task::find($id);

            ResponseUtils::checkTask($task);

            return ResponseUtils::response('Success', $task, 200);
        } catch (TaskNotFoundException $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 500);
        }
    }

    /**
     * Válida os parâmetros passados e atualiza uma tarefa específica retornando o objeto atualizado.
     * @param UpdateTask $request // Request personalizado para validação
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateTask $request, string $id): JsonResponse
    {
        try {
            $task = Task::find($id);

            ResponseUtils::checkTask($task);

            $task->update($request->validated());

            return ResponseUtils::response('Success', $task, 200);
        } catch (TaskNotFoundException $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 500);
        }
    }

    /**
     * Remove uma task específica quando encontrada.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $task = Task::find($id);

            ResponseUtils::checkTask($task);

            $task->delete();

            return ResponseUtils::response('Success', "Tarefa deletada com sucesso!", 200);
        } catch (TaskNotFoundException $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 404);
        } catch (\Exception $ex) {
            return ResponseUtils::response('Error', $ex->getMessage(), 500);
        }
    }
}
