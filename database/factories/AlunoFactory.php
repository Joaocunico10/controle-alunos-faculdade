<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->unique()->numerify('###########'),
            'email' => fake()->unique()->safeEmail(),
            'matricula' => fake()->unique()->numerify('20260#####'),
            'data_nascimento' => fake()->dateTimeBetween('-30 years', '-17 years')->format('Y-m-d'),
            'curso_id' => Curso::factory(),
        ];
    }
}
