@extends('layouts.list')

@section('title', 'Meus cupons')

@section('content_header')
    <h1>Lista de cupon</h1>
@stop

@section('table_content')
    @include('partials.list-items', [
        'fields' => [
            'created_at' => 'Data',
            'refeicao.name' => 'Refeição',
            'refeicao.valor' => 'Valor',
            'horario_utilizacao' => 'Horário da Utilização',
        ],
        'items' => $cupomalimentacaos,
    ])
@stop