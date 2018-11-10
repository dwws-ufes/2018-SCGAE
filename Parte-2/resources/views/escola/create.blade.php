@extends('layouts.forms.create')

@section('title', 'Inserir Escola')

@section('content_header')
<h1>Inserir Escola</h1>
@stop

@section('form_action')
<?php echo route('escola.store'); ?>
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
'field_name' =>'cnpj',
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.cnpj'),
'value' => old('cnpj'),
])

@foreach(['logradouro', 'numero', 'complemento', 'cep', 'bairro', 'cidade', 'estado', 'pais'] as $field_name)
@include('partials.forms.field', [
'field_name' => $field_name,
'type' => 'text',
'placeholder' => trans('adminlte::adminlte.' . $field_name),
'value' => old($field_name),
])
@endforeach

@stop
