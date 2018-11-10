@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    
    <div style="text-align: center; width: 400px; padding: 30px; background-color: #fff;margin-left: auto;margin-right: auto;">

        <h1>Cupom Alimentação</h1>
        <h2>{{ $refeicao['name'] }}</h2>
        <h3>Aluno: {{ $user['name'] }}</h3>
        <h3>Matrícula: {{ $aluno['matricula'] }}</h3>
        <h4> Código para validação do cupom: {{ $cupomalimentacao['id'] }} </h4>
        <?php
        	//$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
			//echo $generator->getBarcode(intval($cupomAlimentacao['id']), $generator::TYPE_CODE_128);
        ?>
        <br><br><br>
        ____________________________________________
        <br>
        Assinatura do Aluno
    </div>

    {{-- <a href="/cupomalimentacao/today">Voltar para cupons do dia.</a> --}}


@stop