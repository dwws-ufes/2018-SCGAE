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
              <h3 class="box-title">Tabela de refeicoes registradas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                {{-- <thead> --}}
                <tr>
                  <th>Nome</th>
                  <th>Valor</th>
                  <th>Inicio</th>
                  <th>Termino</th>
                  <th>Ações</th>
                </tr>
                {{-- </thead> --}}
                {{-- <tbody> --}}
            
                @foreach($refeicaos as $refeicao)
                    <tr>
                        <td> {{ $refeicao->name }} </td>
                        <td> {{ $refeicao->valor }}</td>
                        <td> {{ $refeicao->inicio }}</td>
                        <td> {{ $refeicao->termino }} </td>
                        <td><a href="<?php echo url("/refeicao/{$refeicao->id}"); ?>">Editar</a></td>
                    </tr>
                    
                    

                @endforeach

            </table>
        </div>
    </div>
</div>
</div>
</section>
@stop