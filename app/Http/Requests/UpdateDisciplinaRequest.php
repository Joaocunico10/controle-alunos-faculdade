<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDisciplinaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('disciplinas', 'codigo')->ignore($this->route('disciplina')),
            ],
            'carga_horaria' => 'required|integer|min:1',
            'professor_id' => 'required|exists:professors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da disciplina é obrigatório.',
            'codigo.required' => 'O código da disciplina é obrigatório.',
            'codigo.unique' => 'Este código já está cadastrado.',
            'carga_horaria.required' => 'A carga horária é obrigatória.',
            'carga_horaria.integer' => 'A carga horária deve ser um número inteiro.',
            'carga_horaria.min' => 'A carga horária deve ser maior que zero.',
            'professor_id.required' => 'Selecione um professor.',
            'professor_id.exists' => 'O professor selecionado não é válido.',
        ];
    }
}