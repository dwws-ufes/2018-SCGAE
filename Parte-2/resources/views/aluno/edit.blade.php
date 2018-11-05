@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Editar Aluno</h1>
@stop

@section('content')

    <div class="register-box">

        <div class="register-box-body">

            {{-- {{ dd($user)}} --}}
           
            <form action="<?php echo route('aluno.update',['aluno' => $aluno]); ?>" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{ $user['name'] }}"
                           placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ $user['email'] }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group has-feedback {{ $errors->has('telefone') ? 'has-error' : '' }}">
                    <input type="text" name="telefone" class="form-control" value="{{ $aluno['telefone'] }}"
                           placeholder="{{ trans('adminlte::adminlte.phone') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('telefone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('matricula') ? 'has-error' : '' }}">
                    <input type="text" name="matricula" class="form-control" value="{{ $aluno['matricula'] }}"
                           placeholder="{{ trans('adminlte::adminlte.matricula') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('matricula'))
                        <span class="help-block">
                            <strong>{{ $errors->first('matricula') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('cpf') ? 'has-error' : '' }}">
                    <input type="text" name="cpf" class="form-control" value="{{ $aluno['cpf'] }}"
                           placeholder="{{ trans('adminlte::adminlte.cpf') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('rendaFamiliar') ? 'has-error' : '' }}">
                    <input type="text" name="rendaFamiliar" class="form-control" value="{{ $aluno['rendaFamiliar'] }}"
                           placeholder="{{ trans('adminlte::adminlte.renda_familiar') }}">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('rendaFamiliar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rendaFamiliar') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('auxilioAlimentacao') ? 'has-error' : '' }}">
                    <input type="checkbox" name="auxilioAlimentacao" value="{{ $aluno['auxilioAlimentacao'] }}"  >
                    <span class="">{{ trans('adminlte::adminlte.auxilio_alimentacao') }}</span>
                    @if ($errors->has('auxilioAlimentacao'))
                        <span class="help-block">
                            <strong>{{ $errors->first('auxilioAlimentacao') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('auxilioTransporte') ? 'has-error' : '' }}">
                    <input type="checkbox" name="auxilioTransporte" value="{{ $aluno['auxilioTransporte'] }}"  >
                    <span class="">{{ trans('adminlte::adminlte.auxilio_transporte') }}</span>
                    @if ($errors->has('auxilioTransporte'))
                        <span class="help-block">
                            <strong>{{ $errors->first('auxilioTransporte') }}</strong>
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