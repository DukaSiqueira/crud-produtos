<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Registro(s) não encontrado(s).');
    }
}
