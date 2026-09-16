<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;

class ProfessorController extends Controller
{
    public function index()
    {
        $professores = Professor::all();

        return view('professores.index', compact('professores'));
    }

    public function create()
    {
        return view('professores.create');
    }

    public function store(StoreProfessorRequest $request)
    {
        Professor::create($request->validated());

        return redirect()
            ->route('professores.index')
            ->with('success', 'Professor cadastrado com sucesso!');
    }

    public function show(Professor $professore)
    {
        return view('professores.show', [
            'professor' => $professore
        ]);
    }

    public function edit(Professor $professore)
    {
        return view('professores.edit', [
            'professor' => $professore
        ]);
    }

    public function update(UpdateProfessorRequest $request, Professor $professore)
    {
        $professore->update($request->validated());

        return redirect()
            ->route('professores.index')
            ->with('success', 'Professor atualizado com sucesso!');
    }

    public function destroy(Professor $professore)
    {
        $professore->delete();

        return redirect()
            ->route('professores.index')
            ->with('success', 'Professor excluído com sucesso!');
    }
}