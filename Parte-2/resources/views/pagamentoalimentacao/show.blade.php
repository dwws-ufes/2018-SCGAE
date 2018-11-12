@inject('helper', 'App\Services\ViewsHelperService')

@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Detalhes de Pagamento de Alimentação</h1>
@stop

@section('content')
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2 class="box-title">Valor total do pagamento: {{ $pagamentoalimentacao->valor }}</h2>
              <br>
              <h2 class="box-title">Data do pagamento: {!! $helper->formatDate($pagamentoalimentacao->data_pagamento, 'd/m/Y')  !!}</h2>
              

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
            
                @foreach($pagamentoalimentacao->cupomalimentacao as $cupom)
                    <tr>
                      <td> {!! $helper->formatDate($cupom->created_at, 'd/m/Y')  !!}</td>
                      <td> {{ $cupom->aluno->user->name }} </td>
                      <td> {{ $cupom->refeicao->name }} </td>
                      <td> {{ $cupom->refeicao->valor }} </td>
                    </tr>
                    
                    

                @endforeach

              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

@stop