<?php

namespace App\Utils;

use App\Exceptions\TaskNotFound;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ResponseUtils
{
    /**
     * Verifica se a task foi encontrada e retorna a resposta JSON apropriada.
     *
     * @param $task
     * @return JsonResponse|mixed
     * @throws TaskNotFound
     */
    public static function checkTask($task): mixed
    {
        if (!$task) {
            throw new TaskNotFound();
        }

        return $task;
    }

    /**
     * Verifica se as tasks foram encontradas e retorna a resposta JSON apropriada.
     * @param $tasks
     * @return Collection
     * @throws TaskNotFound
     */
    public static function checkTaskArray($tasks): Collection
    {
        if ($tasks->isEmpty()) {
            throw new TaskNotFound();
        }

        return $tasks;
    }

    /**
     * Retorna uma resposta JSON de erro.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function errorResponse(string $message, int $statusCode): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message
        ], $statusCode);
    }

    /**
     * Retorna uma resposta JSON de sucesso.
     *
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function successResponse($data, int $statusCode): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], $statusCode);
    }
}
