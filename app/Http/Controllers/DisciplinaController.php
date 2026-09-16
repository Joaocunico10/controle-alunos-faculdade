<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Professor;
use App\Http\Requests\StoreDisciplinaRequest;
use App\Http\Requests\UpdateDisciplinaRequest;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::with('professor')->get();

        return view('disciplinas.index', compact('disciplinas'));
    }

    public function create()
    {
        $professores = Professor::all();

        return view('disciplinas.create', compact('professores'));
    }

    public function store(StoreDisciplinaRequest $request)
    {
        Disciplina::create($request->validated());

        return redirect()
            ->route('disciplinas.index')
            ->with('success', 'Disciplina cadastrada com sucesso!');
    }

    public function show(Disciplina $disciplina)
    {
        $disciplina->load('professor');

        return view('disciplinas.show', compact('disciplina'));
    }

    public function edit(Disciplina $disciplina)
    {
        $professores = Professor::all();

        return view('disciplinas.edit', compact('disciplina', 'professores'));
    }

    public function update(UpdateDisciplinaRequest $request, Disciplina $disciplina)
    {
        $disciplina->update($request->validated());

        return redirect()
            ->route('disciplinas.index')
            ->with('success', 'Disciplina atualizada com sucesso!');
    }

    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();

        return redirect()
            ->route('disciplinas.index')
            ->with('success', 'Disciplina excluída com sucesso!');
    }
}