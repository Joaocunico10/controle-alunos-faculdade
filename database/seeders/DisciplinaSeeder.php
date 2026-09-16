<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disciplina;
use App\Models\Professor;

class DisciplinaSeeder extends Seeder
{
    public function run(): void
    {
        $dionathan = Professor::where('email', 'dionathan@faculdade.com')->first();
        $thais = Professor::where('email', 'thais@faculdade.com')->first();
        $bruno = Professor::where('email', 'bruno@faculdade.com')->first();

        Disciplina::create([
            'nome' => 'Banco de Dados',
            'codigo' => 'BD001',
            'carga_horaria' => 80,
            'professor_id' => $bruno->id,
        ]);

        Disciplina::create([
            'nome' => 'Programação Web',
            'codigo' => 'PW001',
            'carga_horaria' => 80,
            'professor_id' => $dionathan->id,
        ]);

        Disciplina::create([
            'nome' => 'Engenharia de Software',
            'codigo' => 'ES001',
            'carga_horaria' => 60,
            'professor_id' => $thais->id,
        ]);

        Disciplina::create([
            'nome' => 'Programação Orientada a Objetos',
            'codigo' => 'POO001',
            'carga_horaria' => 80,
            'professor_id' => $dionathan->id,
        ]);
    }
}