<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlunoRequest;
use App\Http\Requests\UpdateAlunoRequest;
use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
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
    public function store(StoreAlunoRequest $request): RedirectResponse
    {
        Aluno::create($request->validated());

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
    public function update(UpdateAlunoRequest $request, Aluno $aluno): RedirectResponse
    {
        $aluno->update($request->validated());

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
}
