<?php

namespace App;

class UserAluno extends User
{
    protected $table = 'users';

    /**
     * Get the aluno record associated with the user.
     */
    public function aluno()
    {
        return $this->hasOne('App\Aluno', 'user_id');
    }
}
