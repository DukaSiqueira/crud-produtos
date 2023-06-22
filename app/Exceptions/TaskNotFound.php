<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('Task not found');
    }
}
