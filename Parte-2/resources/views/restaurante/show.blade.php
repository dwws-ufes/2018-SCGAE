@extends('adminlte::page')

@section('title', 'Restaurante - ' . $restaurante->user->name)

@section('content_header')
    <h1>Restaurante - {{ $restaurante->user->name }}</h1>
@stop
@section ('content')
    <div class="box box-warning">
        <div class="box-body table-responsive">
            @include ('partials.show-entity', [ 'entity' => $restaurante, 'fields' => [
                'id' => 'Identificador',
                'user.name' => 'Nome',
                'user.email' => 'E-mail',
                'cnpj' => 'CNPJ',
                'telefone' => 'Telefone',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em'
            ] ])
        </div>
    </div>
@endsection