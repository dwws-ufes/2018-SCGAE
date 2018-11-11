@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Lista de Alunos Cadastados</h1>
@stop

@section('content')

    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabela de dados de alunos registrados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                {{-- <thead> --}}
                <tr>
                  <th>Nome</th>
                  <th>Matrícula</th>
                  <th>CPF</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th>Renda Familiar</th>
                  <th>Auxílio Alimentação</th>
                  <th>Auxílio Trnsporte</th>
                  <th>Ações</th>
                </tr>
                {{-- </thead> --}}
                {{-- <tbody> --}}
            
                @foreach($alunos as $aluno)
                    <tr>
                        <td> {{ $aluno->name }} </td>
                        <td> {{ $aluno->matricula }}</td>
                        <td> {{ $aluno->cpf }}</td>
                        <td> {{ $aluno->email }} </td>
                        <td> {{ $aluno->telefone }} </td>
                        <td> {{ $aluno->rendaFamiliar }} </td>
                        <td> {{ $aluno->auxilioAlimentacao }} </td>
                        <td> {{ $aluno->auxilioTransporte }} </td>
                        <td><a href="<?php echo url("/aluno/{$aluno->id}/edit"); ?>">Editar</a></td>
                    </tr>
                    
                    

                @endforeach

            </table>
        </div>
    </div>
</div>
</div>
</section>
@stop