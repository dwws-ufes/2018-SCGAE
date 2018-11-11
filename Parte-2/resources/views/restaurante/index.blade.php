@extends('layouts.list')

@section('title', 'Lista de Restaurantes')

@section('content_header')
    <h1>Lista de Restaurantes Cadastados</h1>
@stop

@section('table_content')
    @include('partials.list-items', [
        'fields' => [
            'user.name' => 'Nome',
            'cnpj' => 'CNPJ',
            'user.email' => 'Email',
        ],
        'items' => $restaurantes,
        'acoes' => [
            'restaurante.edit' => [
                'params' => ['id'],
                'link' => 'Editar'
            ]
        ],
    ])
@stop