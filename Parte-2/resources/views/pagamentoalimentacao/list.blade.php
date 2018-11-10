@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Lista de Pagamentos</h1>
@stop

@section('content')

    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabela de pagamentos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                {{-- <thead> --}}
                <tr>
                  <th>ID</th>
                  <th>Valor</th>
                  <th>Data do Pagamento</th>
                  <th>Ações</th>
                </tr>
                {{-- </thead> --}}
                {{-- <tbody> --}}
            
                @foreach($pagamentos as $pagamento)
                    <tr>
                        <td> {{ $pagamento->id }} </td>
                        <td> {{ $pagamento->valor }}</td>
                        <td>
                          <?php if($pagamento->data_pagamento==null){
                            echo 'Pagamento em aberto';
                          }else{
                            echo $pagamento->data_pagamento;
                          }
                          ?>
                        </td>
                        <td>
                          <?php if($pagamento->data_pagamento==null){
                            echo 'Ir para tela de criação deste pagamento';
                          }else{
                            echo "Ver cupons deste pagamento";
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