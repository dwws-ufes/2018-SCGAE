<?php

namespace App\Repositories\Eloquent;

use App\Aluno;
use App\Repositories\Contracts\AlunoRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentAlunoRepository extends AbstractRepository implements AlunoRepository
{
    public function entity()
    {
        return Aluno::class;
    }
}
