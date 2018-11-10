@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Criando Pagamento de Cupom Alientacaçõ</h1>
@stop

@section('content')
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2 class="box-title">Valor total do pagamento: {{ $pagamentoalimentacao->valor }}</h2>
              <br>
              <h2 class="box-title">Data do pagamento: {{ $pagamentoalimentacao->data_pagamento }}</h2>
              

              <br><br>
              <h3 class="box-title">Lista de cupons deste pagamento:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                {{-- <thead> --}}
                <tr>
                  <th>Data</th>
                  <th>Aluno</th>
                  <th>Refeição</th>
                  <th>Valor</th>
                  {{-- <th>Horário da utilização</th> --}}
                  {{-- <th>Ações</th> --}}
                </tr>
                {{-- </thead> --}}
                {{-- <tbody> --}}
            
                @foreach($cupomalimentacaos as $cupom)
                    <tr>
                      <td> {{ $cupom->cupom_data }} </td>
                      <td> {{ $cupom->aluno_name }} </td>
                      <td> {{ $cupom->refeicao_name }} </td>
                      <td> {{ $cupom->refeicao_valor }} </td>
                    </tr>
                    
                    

                @endforeach

              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

@stop