<?php

namespace App\Repositories\Eloquent;

use App\Refeicao;
use App\Repositories\Contracts\RefeicaoRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentRefeicaoRepository extends AbstractRepository implements RefeicaoRepository
{
    public function entity()
    {
        return Refeicao::class;
    }
}
