<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class PagamentoAlimentacao extends Model
{
    //

     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor',
        'data_pagamento'
    ];
    
    /**
     * The cupomalimentacaos associated with pagamentoalimentacao
     */
    public function cupomalimentacao()
    {
        return $this->hasMany('App\CupomAlimentacao');
    }
}
