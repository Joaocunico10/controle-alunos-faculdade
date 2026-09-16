<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        Professor::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'titulacao' => $request->titulacao,
        ]);

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

    public function update(Request $request, Professor $professore)
    {
        $professore->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'titulacao' => $request->titulacao,
        ]);

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