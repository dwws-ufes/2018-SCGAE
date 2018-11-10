@extends('layouts.forms.create')

@section('title', 'Inserir Novo Aluno')

@section('content_header')
    <h1>Inserir Novo Aluno</h1>
@stop

@section('form_action')
<?php echo route('aluno.store'); ?>
@stop



@section('form_fields')

@include('partials.forms.field', [
'field_name' =>'name',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.full_name'),
'value' => old('name'),
])

@include('partials.forms.field', [
'field_name' =>'email',
'type' => 'email',
'placeholder' => trans('adminlte::adminlte.email'),
'value' => old('email'),
])

<?php $passwd = md5(uniqid(rand(), true)); ?>

@include('partials.forms.field', [
'attributes' => 'hidden',
'field_name' =>'password',
'type' => 'password',
'placeholder' => trans('adminlte::adminlte.password'),
'value' => $passwd,
])

@include('partials.forms.field', [
'attributes' => 'hidden',
'field_name' =>'password_confirmation',
'type' => 'password',
'placeholder' => trans('adminlte::adminlte.retype_password'),
'value' => $passwd,
])

@include('partials.forms.field', [
'field_name' =>'telefone',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.phone'),
'value' => old('telefone'),
])

@foreach(['matricula', 'cpf', 'logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado', 'pais'] as $field_name)
@include('partials.forms.field', [
'field_name' => $field_name,
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.' . $field_name),
'value' => old($field_name),
])
@endforeach

@include('partials.forms.field', [
'field_name' =>'rendaFamiliar',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.renda_familiar'),
'value' => old('rendaFamiliar'),
])
@include('partials.forms.field', [
'field_name' =>'auxilioAlimentacao',
'type' => 'checkbox',
'placeholder' => trans('adminlte::adminlte.auxilio_alimentacao'),
'value' => old('auxilioAlimentacao'),
])

@include('partials.forms.field', [
'field_name' =>'auxilioTransporte',
'type' => 'checkbox',
'placeholder' => trans('adminlte::adminlte.auxilio_transporte'),
'value' => old('auxilioTransporte'),
])
@stop
