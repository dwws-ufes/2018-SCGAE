@extends('layouts.forms.edit')

@section('title', 'Editar Restaurante')

@section('content_header')
    <h1>Editar Restaurante</h1>
@stop

@section('form_action')
{{ route('restaurante.update',['restaurante' => $restaurante]) }}
@stop

@section('form_fields')

@include('partials.forms.field', [
'field_name' =>'name',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.full_name'),
'value' => $restaurante->user->name,
])

@include('partials.forms.field', [
'field_name' =>'email',
'type' => 'email',
'placeholder' => trans('adminlte::adminlte.email'),
'value' => $restaurante->user->email,
])

@include('partials.forms.field', [
'field_name' =>'cnpj',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.cnpj'),
'value' => $restaurante->cnpj,
])

@include('partials.forms.field', [
'field_name' =>'telefone',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.phone'),
'value' => $restaurante->telefone,
])
@stop
