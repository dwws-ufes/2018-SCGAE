<?php

namespace App\Repositories\Eloquent;

use App\CupomAlimentacao;
use App\Repositories\Contracts\CupomAlimentacaoRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentCupomAlimentacaoRepository extends AbstractRepository implements CupomAlimentacaoRepository
{
    public function entity()
    {
        return CupomAlimentacao::class;
    }
}
