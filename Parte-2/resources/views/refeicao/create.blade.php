@extends('layouts.forms.create')

@section('title', 'Inserir Refeição')

@section('content_header')
    <h1>Inserir Refeição</h1>
@stop

@section('form_action')
<?php echo route('refeicao.store'); ?>
@stop


@section('form_fields')

@include('partials.forms.field', [
'field_name' =>'name',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.full_name'),
'value' => old('name'),
])

@include('partials.forms.field', [
'field_name' =>'valor',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.valor'),
'value' => old('valor'),
])


@include('partials.forms.field', [
'field_name' =>'inicio',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.inicio'),
'value' => old('inicio'),
])

@include('partials.forms.field', [
'field_name' =>'termino',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.termino'),
'value' => old('termino'),
])

@stop