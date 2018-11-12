@extends('layouts.list')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Lista de Alunos Cadastados</h1>
@stop

@section('table_content')
    @include('partials.list-items', [
        'fields' => [
            'user.name' => 'Nome',
            'formatted_created_at' => 'Criado em',
            'matricula' => 'Matrícula',
            'cpf' => 'CPF',
            'user.email' => 'Email',
            'telefone' => 'Telefone',
            'rendaFamiliar' => 'Renda Familiar',
            'auxilioAlimentacao' => 'Auxílio Alimentação',
            'auxilioTransporte' => 'Auxílio Transporte',
        ],
        'items' => $alunos,
        'acoes' => [
            'aluno.show' => [
                'params' => ['id'],
                'link' => 'Ver'
            ],
            'aluno.edit' => [
                'params' => ['id'],
                'link' => 'Editar'
            ],
        ],
    ])
@stop