@extends('layouts.list')

@section('title', 'Lista de Escolas')

@section('content_header')
    <h1>Lista de Escolas Cadastados</h1>
@stop

@section('table_content')
    @include('partials.list-items', [
        'fields' => [
            'user.name' => 'Nome',
            'cnpj' => 'CNPJ',
            'user.email' => 'Email',
        ],
        'items' => $escolas,
        'acoes' => [
            'escola.edit' => [
                'params' => ['id'],
                'link' => 'Editar'
            ]
        ],
    ])
@stop