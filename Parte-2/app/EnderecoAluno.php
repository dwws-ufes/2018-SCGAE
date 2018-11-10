<?php

namespace App;

class EnderecoAluno extends Endereco
{
    protected $table = 'enderecos';

    /**
     * Get the aluno record associated with the endereco.
     */
    public function aluno()
    {
        return $this->hasOne('App\Aluno', 'endereco_id');
    }
}
