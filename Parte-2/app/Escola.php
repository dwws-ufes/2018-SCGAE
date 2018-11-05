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
     * The user associated with aluno
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
