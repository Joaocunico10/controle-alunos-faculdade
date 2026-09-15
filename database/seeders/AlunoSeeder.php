<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos = Curso::all();

        if ($cursos->isEmpty()) {
            $cursos = Curso::factory()->count(3)->create();
        }

        // Distribui alunos entre os cursos existentes para testar o relacionamento Curso hasMany Aluno.
        $cursos->each(function (Curso $curso) {
            Aluno::factory()
                ->count(fake()->numberBetween(3, 6))
                ->create(['curso_id' => $curso->id]);
        });
    }
}
