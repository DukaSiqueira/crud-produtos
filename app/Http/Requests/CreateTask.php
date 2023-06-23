<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTask extends FormRequest
{
     // Determina se o usuário está autorizado a fazer este pedido
    public function authorize(): bool
    {
        return true;
    }

    // Define os atributos que serão validados e suas regras
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:tasks|min:3|max:255',
            'description' => 'required|string|min:4|max:255',
        ];
    }

    // Define os mensagens de erro
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
        ];
    }

    // Tratamento dos erros de validação
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),  422));
    }
}
