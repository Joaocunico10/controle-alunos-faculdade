<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professor;

class ProfessorSeeder extends Seeder
{
    public function run(): void
    {
        Professor::create([
            'nome' => 'Dionathan',
            'email' => 'dionathan@faculdade.com',
            'titulacao' => 'Mestre',
        ]);

        Professor::create([
            'nome' => 'Thais',
            'email' => 'thais@faculdade.com',
            'titulacao' => 'Doutora',
        ]);

        Professor::create([
            'nome' => 'Bruno',
            'email' => 'bruno@faculdade.com',
            'titulacao' => 'Especialista',
        ]);
    }
}