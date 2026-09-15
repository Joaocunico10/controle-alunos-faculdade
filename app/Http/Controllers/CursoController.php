<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cursos = Curso::withCount('alunos')->orderBy('nome')->paginate(10);

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());

        Curso::create($validated);

        return redirect()->route('cursos.index')->with('status', 'curso-criado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso): View
    {
        $curso->load('alunos');

        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso): View
    {
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso): RedirectResponse
    {
        $validated = $request->validate($this->rules($curso->id));

        $curso->update($validated);

        return redirect()->route('cursos.index')->with('status', 'curso-atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso): RedirectResponse
    {
        $curso->delete();

        return redirect()->route('cursos.index')->with('status', 'curso-removido');
    }

    /**
     * Regras de validação para criação e atualização de cursos.
     */
    private function rules(?int $cursoId = null): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'max:50', 'unique:cursos,codigo,' . $cursoId],
            'duracao_semestres' => ['required', 'integer', 'min:1', 'max:20'],
        ];
    }
}
