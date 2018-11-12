@inject('helper', 'App\Services\ViewsHelperService')


@section('css')
<!-- daterange picker -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/css/select2.min.css">
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
            'created_at' => 'Data',
            'refeicao.name' => 'Refeição',
            'refeicao.valor' => 'Valor',
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



