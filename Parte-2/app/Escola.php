<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Escola extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cnpj'
    ];

    /**
     * The user associated with escola
     */
    public function user()
    {
        return $this->belongsTo('App\UserEscola', 'user_id');
    }

    /**
     * The endereco associated with escola
     */
    public function endereco()
    {
        return $this->belongsTo('App\EnderecoEscola', 'endereco_id');
    }

    /**
     * The alunos associated with escola
     */
    public function alunos()
    {
        return $this->hasMany('App\Aluno');
    }
}
