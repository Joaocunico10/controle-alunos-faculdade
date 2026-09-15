<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $alunos = Aluno::with('curso')->orderBy('nome')->paginate(10);

        return view('alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cursos = Curso::orderBy('nome')->get();

        return view('alunos.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        Aluno::create($validated);

        return redirect()->route('alunos.index')->with('status', 'aluno-criado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno): View
    {
        $aluno->load('curso');

        return view('alunos.show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno): View
    {
        $cursos = Curso::orderBy('nome')->get();

        return view('alunos.edit', compact('aluno', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno): RedirectResponse
    {
        $validated = $request->validate($this->rules($aluno->id));

        $aluno->update($validated);

        return redirect()->route('alunos.index')->with('status', 'aluno-atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno): RedirectResponse
    {
        $aluno->delete();

        return redirect()->route('alunos.index')->with('status', 'aluno-removido');
    }

    /**
     * Regras de validação para criação e atualização de alunos.
     */
    private function rules(?int $alunoId = null): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'unique:alunos,cpf,' . $alunoId],
            'email' => ['required', 'email', 'max:255', 'unique:alunos,email,' . $alunoId],
            'matricula' => ['required', 'string', 'max:50', 'unique:alunos,matricula,' . $alunoId],
            'data_nascimento' => ['required', 'date', 'before:today'],
            'curso_id' => ['required', 'exists:cursos,id'],
        ];
    }
}
