<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTask extends FormRequest
{
    // Determina se o usuário está autorizado a fazer este pedido
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:tasks|min:3|max:255',
            'description' => 'required|string|min:4|max:255',
            'status' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatário',
            'title.string' => 'O título deve ser uma string',
            'title.unique' => 'Já existe uma tarefa com esse título',
            'title.min' => 'O título deve ter pelo menos 3 caracteres',
            'title.max' => 'O título deve ter no máximo 255 caracteres',
            'description.required' => 'A descrição é obrigatária',
            'description.string' => 'A descrição deve ser uma string',
            'description.min' => 'A descrição deve ter pelo menos 4 caracteres',
            'description.max' => 'A descrição deve ter no máximo 255 caracteres',
            'status.required' => 'O status é obrigatário',
            'status.string' => 'O status deve ser uma string',
            'status.in' => 'O status deve ser "pending" ou "completed"',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),  422));
    }
}
