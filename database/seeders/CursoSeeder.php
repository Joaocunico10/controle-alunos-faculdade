<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos = [
            ['nome' => 'Engenharia de Software', 'codigo' => 'ENGSW', 'duracao_semestres' => 8],
            ['nome' => 'Ciência da Computação', 'codigo' => 'CCOMP', 'duracao_semestres' => 8],
            ['nome' => 'Sistemas de Informação', 'codigo' => 'SINFO', 'duracao_semestres' => 8],
            ['nome' => 'Análise e Desenvolvimento de Sistemas', 'codigo' => 'ADS', 'duracao_semestres' => 4],
            ['nome' => 'Redes de Computadores', 'codigo' => 'REDES', 'duracao_semestres' => 6],
        ];

        foreach ($cursos as $curso) {
            Curso::firstOrCreate(['codigo' => $curso['codigo']], $curso);
        }

        // Cursos adicionais gerados aleatoriamente para enriquecer os testes de listagem.
        Curso::factory()->count(3)->create();
    }
}
