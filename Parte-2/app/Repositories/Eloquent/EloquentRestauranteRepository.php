<?php

namespace App\Repositories\Eloquent;

use App\Restaurante;
use App\Repositories\Contracts\RestauranteRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentRestauranteRepository extends AbstractRepository implements RestauranteRepository
{
    public function entity()
    {
        return Restaurante::class;
    }
}
