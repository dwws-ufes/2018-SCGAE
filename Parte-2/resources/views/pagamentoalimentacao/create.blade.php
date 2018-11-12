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
              <h2 class="box-title">Valor total do pagamento até o momento: {{ $pagamentoalimentacaos->valor }}</h2>
              
              <form method="post" action="<?php echo route('pagamentoalimentacao.setpagamento'); ?>" style="float:right;">
                {!! csrf_field() !!}
                <input type="text" name="pagamento_id" value="{{ $pagamentoalimentacaos->id }}" style="display: none;">
                <input type="text" name="action" value="pagar" style="display: none;">
                <button type="submit">Pagar Agora</button>
              </form>

              <br><br>
              <h3 class="box-title">Lista de cupons validados:</h3>
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
                  <th>Ações</th>
                </tr>
                {{-- </thead> --}}
                {{-- <tbody> --}}
            
                @foreach($cupomalimentacaos as $cupom)
                    <tr>
                      <td> {{ $cupom->cupom_data }} </td>
                      <td> {{ $cupom->aluno_name }} </td>
                      <td> {{ $cupom->refeicao_name }} </td>
                      <td> {{ $cupom->refeicao_valor }} </td>
                      <td> 
                          <form method="post" action="<?php echo route('pagamentoalimentacao.setpagamento'); ?>">
                            {!! csrf_field() !!}
                            <input type="text" name="cupom_id" value="{{ $cupom->cupom_id }}" style="display: none;">
                            <input type="text" name="refeicao_valor" value="{{ $cupom->refeicao_valor }}" style="display: none;">
                            <input type="text" name="pagamento_id" value="{{ $pagamentoalimentacaos->id }}" style="display: none;">
                          <?php
                            if($cupom->pagamentoalimentacao_id == $pagamentoalimentacaos->id){
                              ?>
                                <input type="text" name="action" value="excluir" style="display: none;">
                                <button type="submit">Excluir</button>
                              </form>
                              <?php
                            }else{
                              ?>
                                <input type="text" name="action" value="incluir" style="display: none;">
                                <button type="submit">Incluir</button>
                              </form>
                              <?php
                            }
                            ?>
                      </td>
                    </tr>
                    
                    

                @endforeach

              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

@stop