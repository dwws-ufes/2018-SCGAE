@extends('adminlte::page')

@section('content')
<div class="register-box">

    <div class="register-box-body">

        <form action="@yield('form_action')"
              method="post">
            {!! csrf_field() !!}

            @yield('form_fields')

            <button type="submit"
                    class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.register') }}</button>
        </form>
    </div>
    <!-- /.form-box -->
</div><!-- /.register-box -->
@stop
