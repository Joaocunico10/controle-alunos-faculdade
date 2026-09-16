<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Professor;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        Disciplina::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'carga_horaria' => $request->carga_horaria,
            'professor_id' => $request->professor_id,
        ]);

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

    public function update(Request $request, Disciplina $disciplina)
    {
        $disciplina->update([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'carga_horaria' => $request->carga_horaria,
            'professor_id' => $request->professor_id,
        ]);

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