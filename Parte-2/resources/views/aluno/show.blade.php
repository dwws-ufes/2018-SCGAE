@extends('adminlte::page')

@section('title', 'Aluno - ' . $aluno->user->name)

@section('content_header')
    <h1>Aluno - {{ $aluno->user->name }}</h1>
@stop
@section ('content')
    <div class="box box-warning">
        <div class="box-header">

            <a class="btn btn-success btn-large" href="{!! route('semantic.aluno', ['aluno' => $aluno]) !!}">
                Ver em RDF
            </a>
        </div>
        <div class="box-body table-responsive">
            @include ('partials.show-entity', [ 'entity' => $aluno, 'fields' => [
                'id' => 'Identificador',
                'user.name' => 'Nome',
                'user.email' => 'E-mail',
                'telefone' => 'Telefone',
                'matricula' => 'Matrícula',
                'cpf' => 'CPF',
                'rendaFamiliar' => 'RendaFamiliar',
                'auxilioAlimentacao' => 'Auxilio Alimentacao',
                'auxilioTransporte' => 'Auxilio Transporte',
                'endereco.logradouro' => 'Logradouro',
                'endereco.numero' => 'Número',
                'endereco.complemento' => 'Complemento',
                'endereco.cep' => 'CEP',
                'endereco.bairro' => 'Bairro',
                'endereco.cidade' => 'Cidade',
                'endereco.estado' => 'Estado',
                'endereco.pais' => 'País',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em'
            ] ])
        </div>
    </div>
@endsection