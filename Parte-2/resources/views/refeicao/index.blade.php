@extends('layouts.list')

@section('title', 'Lista de Refeições')

@section('content_header')
    <h1>Lista de Refeições Cadastados</h1>
@stop

@section('table_content')
    @include('partials.list-items', [
        'fields' => [
            'name' => 'Nome',
            'valor' => 'Valor',
            'inicio' => 'Início',
            'termino' => 'Término',
        ],
        'items' => $refeicaos,
        'acoes' => [
            'refeicao.show' => [
                'params' => ['id'],
                'link' => 'Ver'
            ],
            'refeicao.edit' => [
                'params' => ['id'],
                'link' => 'Editar'
            ]
        ],
    ])
@stop