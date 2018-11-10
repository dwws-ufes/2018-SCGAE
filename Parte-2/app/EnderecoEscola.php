<?php

namespace App;

class EnderecoEscola extends Endereco
{
    protected $table = 'enderecos';

    /**
     * Get the escola record associated with the endereco.
     */
    public function escola()
    {
        return $this->hasOne('App\Escola', 'endereco_id');
    }
}
