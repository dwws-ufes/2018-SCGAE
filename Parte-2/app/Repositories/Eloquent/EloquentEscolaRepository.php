<?php

namespace App\Repositories\Eloquent;

use App\Escola;
use App\Repositories\Contracts\EscolaRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentEscolaRepository extends AbstractRepository implements EscolaRepository
{
    public function entity()
    {
        return Escola::class;
    }
}
