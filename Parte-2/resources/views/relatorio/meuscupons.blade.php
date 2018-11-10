@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Meus cupons</h1>
@stop

@section('content')

    <div>
        <form method="post" action="<?php echo route('relatorio.meuscupons'); ?>">
            {!! csrf_field() !!}
            <span>Data início</span><input type="text" name="data_inicio" />
            <span>Data fim</span><input type="text" name="data_fim" />

            
            <button type="submit">Gerar</button>
        </form>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabela de cupons emitidos entre --- e ---</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <tr>
                  <th>Data</th>
                  <th>Refeicao</th>
                  <th>Status</th>
                </tr>
            
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