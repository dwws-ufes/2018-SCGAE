@extends('adminlte::page')

@section('title', 'Lista de Alunos')

@section('content_header')
    <h1>Lista de Alunos Cadastados</h1>
@stop

@section('content')

    
    <section class="content">

    	<?php 
    	if(isset($aluno)){
    		

    		?>


    			<form method="post" action="<?php echo route('cupomalimentacao.dovalidate'); ?>">
    				{!! csrf_field() !!}
    				<input type="text" name="cupomalimentacao_id" value="{{ $cupomAlimentacao->id }}" style="display: none;">
    				Id do cupom:{{ $cupomAlimentacao->id }} <br>
    				Refeição: {{ $refeicao->name }} <br>
    				Aluno: {{ $user->name }} <br>
    				Matrícula: {{ $aluno->matricula }} <br>
    				Horário da Emissão: {{ $cupomAlimentacao->created_at }} <br>

    				<?php 
                        $now = Date('H:i:s');
                        if($now<$refeicao->termino){
                            if($now>$refeicao->inicio){
                                if( !isset($cupomAlimentacao->horario_utilizacao)){
                                    ?>
                                        <button type="submit">Confirmar Validação do Cupom</button>
                                    <?php
                                }else{
                                    ?>
                                        <br> CUPOM VALIDADO! <BR>
                                    <?php
                                }
                            }else{
                                ?>
                                <br> ESSA CUPOM É DE UMA REFEIÇÃO QUE AINDA NÃO COMEÇOU <BR>
                                <?php
                            }

                            
                        }else{
                            ?>
                            <br> ESSA CUPOM É DE UMA REFEIÇÃO QUE JÁ TERMINOU <BR>
                            <?php
                        }
    					
    				?>

    				
    				
    			</form>



    		<?php
    	}
    	?>
    	<br>
    	<br>
    	<br>
    	<br>
    	<br>
    	<form method="post" action="<?php echo route('cupomalimentacao.validate'); ?>">
    		{!! csrf_field() !!}
    		
    		<input type="text" name="cupomalimentacao_id" placeholder="Digite o código do cupom">
    		<button type="submit">Validar</button>

    	</form>

	</section>
@stop