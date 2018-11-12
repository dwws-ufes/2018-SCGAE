@extends('layouts.forms.edit')

@section('title', 'Editar Escola')

@section('content_header')
    <h1>Inserir Editar Escola</h1>
@stop

@section('form_action')
{{ route('escola.update',['escola' => $escola]) }}
@stop

@section('form_fields')

@include('partials.forms.field', [
'field_name' =>'name',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.full_name'),
'value' => $escola->user->name,
])

@include('partials.forms.field', [
'field_name' =>'email',
'type' => 'email',
'placeholder' => trans('adminlte::adminlte.email'),
'value' => $escola->user->email,
])

@include('partials.forms.field', [
'field_name' =>'cnpj',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.cnpj'),
'value' => $escola->cnpj,
])


@foreach(['logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado', 'pais'] as $field_name)
@include('partials.forms.field', [
'field_name' => $field_name,
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.' . $field_name),
'value' => $escola->endereco->{$field_name},
])
@endforeach

@stop
