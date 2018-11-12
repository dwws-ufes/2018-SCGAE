<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Services\ViewsHelperService;
use Illuminate\Support\Carbon;
use App\Services\DateFormatService;

class Aluno extends Model
{
    use Notifiable;
    use DateFormatService;


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
        return $this->belongsTo('App\UserAluno', 'user_id');
    }

    /**
     * The escola associated with aluno
     */
    public function escola()
    {
        return $this->belongsTo('App\Escola');
    }

    /**
     * The endereco associated with aluno
     */
    public function endereco()
    {
        return $this->belongsTo('App\EnderecoAluno', 'endereco_id');
    }

    /**
     * Get the cupomalimentacaos for the aluno.
     */
    public function cupomalimentacao()
    {
        return $this->hasMany('App\CupomAlimentacao');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatDate($this->created_at);
    }
}
