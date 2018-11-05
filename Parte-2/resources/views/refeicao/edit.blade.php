@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Editar Aluno</h1>
@stop

@section('content')

    <div class="register-box">

        <div class="register-box-body">

            {{-- {{ dd($user)}} --}}
           
            <form action="<?php echo route('refeicao.update',['refeicao' => $refeicao]); ?>" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ $refeicao['name'] }}"
                           placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group has-feedback {{ $errors->has('valor') ? 'has-error' : '' }}">
                    <input type="text" name="valor" class="form-control" value="{{ $refeicao['valor'] }}"
                           placeholder="{{ trans('adminlte::adminlte.valor') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('valor'))
                        <span class="help-block">
                            <strong>{{ $errors->first('valor') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('inicio') ? 'has-error' : '' }}">
                    <input type="text" name="inicio" class="form-control" value="{{ $refeicao['inicio'] }}"
                           placeholder="{{ trans('adminlte::adminlte.inicio') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('inicio'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inicio') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('termino') ? 'has-error' : '' }}">
                    <input type="text" name="termino" class="form-control" value="{{ $refeicao['termino'] }}"
                           placeholder="{{ trans('adminlte::adminlte.termino') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('termino'))
                        <span class="help-block">
                            <strong>{{ $errors->first('termino') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.refresh') }}</button>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop