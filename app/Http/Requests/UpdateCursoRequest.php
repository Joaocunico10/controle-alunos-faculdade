<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $cursoId = $this->route('curso')?->id;

        return [
            'nome' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'max:50', 'unique:cursos,codigo,' . $cursoId],
            'duracao_semestres' => ['required', 'integer', 'min:1', 'max:20'],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do curso é obrigatório.',
            'codigo.required' => 'O código do curso é obrigatório.',
            'codigo.unique' => 'Este código já está cadastrado.',
            'duracao_semestres.required' => 'A duração em semestres é obrigatória.',
            'duracao_semestres.integer' => 'A duração deve ser um número inteiro.',
            'duracao_semestres.min' => 'A duração deve ser de pelo menos 1 semestre.',
            'duracao_semestres.max' => 'A duração deve ser de no máximo 20 semestres.',
        ];
    }
}
