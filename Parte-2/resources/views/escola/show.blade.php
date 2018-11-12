@extends('adminlte::page')

@section('title', 'Escola - ' . $escola->user->name)

@section('content_header')
    <h1>Escola - {{ $escola->user->name }}</h1>
@stop
@section ('content')
    <div class="box box-warning">
        <div class="box-body table-responsive">
            @include ('partials.show-entity', [ 'entity' => $escola, 'fields' => [
                'id' => 'Identificador',
                'user.name' => 'Nome',
                'user.email' => 'E-mail',
                'cnpj' => 'CNPJ',
                'endereco.logradouro' => 'Logradouro',
                'endereco.numero' => 'Número',
                'endereco.complemento' => 'Complemento',
                'endereco.cep' => 'CEP',
                'endereco.bairro' => 'Bairro',
                'endereco.cidade' => 'Cidade',
                'endereco.estado' => 'Estado',
                'endereco.pais' => 'País',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em'
            ] ])
        </div>
    </div>
@endsection