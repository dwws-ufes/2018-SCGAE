<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Restaurante extends Model
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
        'cnpj',
        'telefone'
    ];
    
    /**
     * The user associated with aluno
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
