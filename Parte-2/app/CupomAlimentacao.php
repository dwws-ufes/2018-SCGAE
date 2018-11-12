<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CupomAlimentacao extends Model
{
    //

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'refeicao_id',
        'aluno_id',
        'pagamentoalimentacao_id'
    ];
    
    /**
     * The aluno associated with cupomalimentacao
     */
    public function aluno()
    {
        return $this->belongsTo('App\Aluno');
    }

    /**
     * The refeicao associated with cupomalimentacao
     */
    public function refeicao()
    {
        return $this->belongsTo('App\Refeicao');
    }

    public function pagamentoalimentacao()
    {
        return $this->belongsTo('App\PagamentoAlimentacao', 'pagamentoalimentacao_id');
    }
}
