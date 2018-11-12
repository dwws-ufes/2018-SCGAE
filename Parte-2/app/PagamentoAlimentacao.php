<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use App\Services\DateFormatService;

class PagamentoAlimentacao extends Model
{
    //

    use Notifiable;
    use DateFormatService;

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
        return $this->hasMany('App\CupomAlimentacao', 'pagamentoalimentacao_id');
    }

    public function somaValor(float $value)
    {
        $this->valor += $value;
    }

    public function setDataPagamento(string $date)
    {
        $this->data_pagamento = $date;
    }
}
