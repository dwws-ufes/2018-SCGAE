@inject('helper', 'App\Services\ViewsHelperService')

@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Criando Pagamento de Cupom Alientação</h1>
@stop

@section('content')
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h2 class="box-title">Valor total do pagamento até o momento: {{ $pagamentoalimentacao->valor }}</h2>
              
              <form method="post" action="<?php echo route('pagamentoalimentacao.dopayment', ['pagamentoalimentacao' => $pagamentoalimentacao->id]); ?>" style="float:right;">
                {!! csrf_field() !!}
                <input type="text" name="pagamento_id" value="{{ $pagamentoalimentacao->id }}" style="display: none;">
                <input type="text" name="action" value="pagar" style="display: none;">
                <button type="submit">Pagar Agora</button>
              </form>

              <br><br>
              <h3 class="box-title">Lista de cupons validados:</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered table-hover datatables">
                
                <tr>
                  <th>Data</th>
                  <th>Aluno</th>
                  <th>Refeição</th>
                  <th>Valor</th>
                  <th>Ações</th>
                </tr>
            
                @foreach($cupomalimentacaos as $cupom)
                <tr>
                  <td> {!! $helper->formatDate($cupom->created_at, 'd/m/Y')  !!} </td>
                  <td> {{ $cupom->aluno->user->name }} </td>
                  <td> {{ $cupom->refeicao->name }} </td>
                  <td> {{ $cupom->refeicao->valor }} </td>
                  <td> 
                      <form method="post" action="<?php echo route('cupomalimentacao.update', ['cupomalimentacao' => $cupom->id]) ?>">
                        {{-- {{method_field('PUT')}} --}}
                        {!! csrf_field() !!}
                        <input type="text" name="cupom_id" value="{{ $cupom->id }}" style="display: none;">
                        <input type="text" name="refeicao_valor" value="{{ $cupom->refeicao->valor }}" style="display: none;">
                        <input type="text" name="pagamento_id" value="{{ $pagamentoalimentacao->id }}" style="display: none;">
                      <?php
                        if($cupom->pagamentoalimentacao_id == $pagamentoalimentacao->id){
                          ?>
                            <input type="text" name="action" value="excluir" style="display: none;">
                            <button type="submit">Excluir</button>
                          <?php
                        }else{
                          ?>
                            <input type="text" name="action" value="incluir" style="display: none;">
                            <button type="submit">Incluir</button>
                          <?php
                        }
                        ?>
                        </form>
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

@section('js')

<script>

  $(function () {
    $('.datatables').DataTable();
  })
</script>

@stop
