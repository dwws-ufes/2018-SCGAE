@extends('layouts.forms.edit')

@section('title', 'Editar Aluno')

@section('content_header')
    <h1>Inserir Editar Aluno</h1>
@stop

@section('form_action')
{{ route('aluno.update',['aluno' => $aluno]) }}
@stop



@section('form_fields')

@include('partials.forms.field', [
'field_name' =>'name',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.full_name'),
'value' => $aluno->user->name,
])

@include('partials.forms.field', [
'field_name' =>'email',
'type' => 'email',
'placeholder' => trans('adminlte::adminlte.email'),
'value' => $aluno->user->email,
])

@include('partials.forms.field', [
'field_name' =>'telefone',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.phone'),
'value' => $aluno->telefone,
])

@foreach(['matricula', 'cpf'] as $field_name)
@include('partials.forms.field', [
'field_name' => $field_name,
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.' . $field_name),
'value' => $aluno->{$field_name},
])
@endforeach

@foreach(['logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado', 'pais'] as $field_name)
@include('partials.forms.field', [
'field_name' => $field_name,
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.' . $field_name),
'value' => $aluno->endereco->{$field_name},
])
@endforeach

@include('partials.forms.field', [
'field_name' =>'rendaFamiliar',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.renda_familiar'),
'value' => $aluno->rendaFamiliar,
])
@include('partials.forms.checkbox', [
'field_name' =>'auxilioAlimentacao',
'placeholder' => trans('adminlte::adminlte.auxilio_alimentacao'),
'value' => $aluno->auxilioAlimentacao,
])

@include('partials.forms.checkbox', [
'field_name' =>'auxilioTransporte',
'placeholder' => trans('adminlte::adminlte.auxilio_transporte'),
'value' => $aluno->auxilioTransporte,
])
@stop
