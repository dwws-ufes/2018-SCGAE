@extends('adminlte::page')

@section('title', 'Lista de Escolas')

@section('content_header')
<h1>Lista de Escolas Cadastados</h1>
@stop

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tabela de dados de escolas registrados</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover">

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
