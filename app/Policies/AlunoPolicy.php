<?php

namespace App\Policies;

use App\Models\Aluno;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlunoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Aluno $aluno): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Aluno $aluno): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * Somente usuários com e-mail verificado podem excluir alunos.
     */
    public function delete(User $user, Aluno $aluno): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Aluno $aluno): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Aluno $aluno): bool
    {
        return $user->hasVerifiedEmail();
    }
}
