@inject('helper', 'App\Services\ViewsHelperService')


@section('css')
@stop


@extends('layouts.list')

@section('title', 'Meus cupons')

@section('content_header')
    <h1>Lista de cupons</h1>
@stop

{{-- filtro de data --}}


@section('table_content')

@include('partials.list-items', [
        'fields' => [
            'formatted_created_at' => 'Data',
            'refeicao_name' => 'Refeição',
            'refeicao_valor' => 'Valor',
            'horario_utilizacao' => 'Horário da Utilização',
        ],
        'items' => $cupomalimentacaos,
    ])
@stop

@section('js')


<script>

  $(function () {


    $('.datatables').DataTable();
    
  })
</script>

@stop



