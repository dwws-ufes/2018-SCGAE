<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Aluno extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telefone',
        'matricula',
        'cpf',
        'rendaFamiliar',
        'auxilioAlimentacao',
        'auxilioTransporte',
        'user_id'
    ];
    
    /**
     * The user associated with aluno
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the cupomalimentacaos for the aluno.
     */
    public function cupomalimentacao()
    {
        return $this->hasMany('App\CupomAlimentacao');
    }

}
