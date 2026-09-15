<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Curso::class);

        $cursos = Curso::withCount('alunos')->orderBy('nome')->paginate(10);

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Curso::class);

        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCursoRequest $request): RedirectResponse
    {
        $this->authorize('create', Curso::class);

        Curso::create($request->validated());

        return redirect()->route('cursos.index')->with('status', 'curso-criado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso): View
    {
        $this->authorize('view', $curso);

        $curso->load('alunos');

        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso): View
    {
        $this->authorize('update', $curso);

        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCursoRequest $request, Curso $curso): RedirectResponse
    {
        $this->authorize('update', $curso);

        $curso->update($request->validated());

        return redirect()->route('cursos.index')->with('status', 'curso-atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso): RedirectResponse
    {
        $this->authorize('delete', $curso);

        $curso->delete();

        return redirect()->route('cursos.index')->with('status', 'curso-removido');
    }
}
