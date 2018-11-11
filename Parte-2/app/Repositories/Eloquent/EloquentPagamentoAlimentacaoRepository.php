<?php

namespace App\Repositories\Eloquent;

use App\PagamentoAlimentacao;
use App\Repositories\Contracts\PagamentoAlimentacaoRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentPagamentoAlimentacaoRepository extends AbstractRepository implements PagamentoAlimentacaoRepository
{
    public function entity()
    {
        return PagamentoAlimentacao::class;
    }
}
