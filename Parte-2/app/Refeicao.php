<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Refeicao extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'valor',
        'inicio',
        'termino'
    ];

    /**
     * Get the cupomalimentacaos for the aluno.
     */
    // public function cupomalimentacao()
    // {
    //     return $this->hasMany('App\CupomAlimentacao');
    // }
}
