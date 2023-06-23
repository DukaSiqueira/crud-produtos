<?php

namespace App\Utils;

use App\Exceptions\TaskNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ResponseUtils
{
    /**
     * Verifica se a tarefa foi encontrada e retorna a resposta JSON apropriada.
     *
     * @param $task
     * @return JsonResponse|mixed
     * @throws TaskNotFoundException
     */
    public static function checkTask($task): mixed
    {
        if (!$task) {
            throw new TaskNotFoundException();
        }

        return $task;
    }

    /**
     * Verifica se as tarefas foram encontradas e retorna a resposta JSON apropriada.
     * @param $tasks
     * @return Collection
     * @throws TaskNotFoundException
     */
    public static function checkTaskArray($tasks): Collection
    {
        if ($tasks->isEmpty()) {
            throw new TaskNotFoundException();
        }

        return $tasks;
    }

    /**
     * Retorna uma resposta JSON.
     *
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function response(string $status, mixed $data, int $statusCode): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'data' => $data
        ], $statusCode);
    }


}
