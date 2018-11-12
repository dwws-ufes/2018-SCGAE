@extends('adminlte::page')

@section('title', 'Refeição - ' . $refeicao->name)

@section('content_header')
    <h1>Refeição - {{ $refeicao->name }}</h1>
@stop
@section ('content')
    <div class="box box-warning">
        <div class="box-body table-responsive">
            @include ('partials.show-entity', [ 'entity' => $refeicao, 'fields' => [
                'id' => 'Identificador',
                'name' => 'Nome',
                'valor' => 'Valor',
                'inicio' => 'Início',
                'termino' => 'Término',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em'
            ] ])
        </div>
    </div>
@endsection