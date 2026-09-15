<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'matricula',
        'data_nascimento',
        'curso_id',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /**
     * Um aluno pertence a um curso.
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }
}
