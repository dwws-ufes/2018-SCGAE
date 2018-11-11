@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Lista de Cupons do dia</h1>
@stop

@section('content')
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de cupons do dia</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                {{-- <thead> --}}
                <tr>
                  <th>Refeição (início - término)</th>
                  <th>Valor</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                {{-- </thead> --}}
                {{-- <tbody> --}}
            
                @foreach($refeicaos as $refeicao)
                    <tr>
                        <td>{{ $refeicao->name }} ({{ $refeicao->inicio }} - {{ $refeicao->termino }})</td>
                        <td>{{ $refeicao->valor }}</td>
                        <td>
                          <?php 
                            if ($refeicao->emissao_cupom != null){
                              ?>
                              Emitido - 
                              <?php
                              if($refeicao->horario_utilizacao != null){
                                ?>
                                Utilizado
                                <?php
                              }else{
                                ?>
                                Não Utilizado
                                <?php
                              }
                            }else{
                              ?>
                              Não Emitido
                              <?php
                            }
                          ?>
                          
                        </td>
                        <td>

                          <?php
                          if(Date('H-i-s')<$refeicao->termino){
                            if($refeicao->emissao_cupom == null){
                              ?>
                              
                              <form action="<?php echo route('cupomalimentacao.store'); ?>"  method="post">
                                {!! csrf_field() !!}
                                <input type="text" name="refeicaoId" style="display: none;" value="<?php echo $refeicao->id ?>">
                                <input type="text" name="alunoId" style="display: none;" value="<?php echo $aluno->id ?>">
                                <button type="submit">Emitir</button>
                              </form>
                              <?php

                            }else{
                              if($refeicao->horario_utilizacao == null){
                                ?>

                                  <a href="/cupomalimentacao/print/{{ $refeicao->id_cupom }}">Imprimir</a>
                                <?php

                              }else{

                                ?>
                                  Não há ação
                                <?php
                              
                              
                              }
                            } 
                            }else{
                              ?>
                              Tempo de emissão encerrado
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