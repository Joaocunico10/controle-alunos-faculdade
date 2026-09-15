<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlunoRequest extends FormRequest
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
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'unique:alunos,cpf'],
            'email' => ['required', 'email', 'max:255', 'unique:alunos,email'],
            'matricula' => ['required', 'string', 'max:50', 'unique:alunos,matricula'],
            'data_nascimento' => ['required', 'date', 'before:today'],
            'curso_id' => ['required', 'exists:cursos,id'],
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
            'nome.required' => 'O nome do aluno é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'matricula.required' => 'A matrícula é obrigatória.',
            'matricula.unique' => 'Esta matrícula já está cadastrada.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date' => 'Informe uma data válida.',
            'data_nascimento.before' => 'A data de nascimento deve ser anterior à data de hoje.',
            'curso_id.required' => 'Selecione um curso.',
            'curso_id.exists' => 'O curso selecionado é inválido.',
        ];
    }
}
