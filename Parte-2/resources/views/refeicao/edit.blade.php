@extends('layouts.forms.edit')

@section('title', 'Editar Refeição')

@section('content_header')
    <h1>Editar Refeição</h1>
@stop

@section('form_action')
{{ route('refeicao.update',['refeicao' => $refeicao]) }}
@stop

@section('form_fields')

@include('partials.forms.field', [
'field_name' =>'name',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.full_name'),
'value' => $refeicao->name,
])


@include('partials.forms.field', [
'field_name' =>'valor',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.valor'),
'value' => $refeicao->valor,
])


@include('partials.forms.field', [
'field_name' =>'inicio',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.inicio'),
'value' => $refeicao->inicio,
])

@include('partials.forms.field', [
'field_name' =>'termino',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.termino'),
'value' => $refeicao->termino,
])


@stop
