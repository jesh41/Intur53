@extends('layouts.login')
@section('pageTitle', 'Iniciar Sesión')
@section('content')

    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="card card-login card-hidden">
            <div class="card-header text-center" data-background-color="rose">
                <h4 class="card-title">Recuperar tu contraseña</h4>
            </div>

            <div class="card-content">

                <div class="input-group">
                    <span class="input-group-addon">
                          <i class="material-icons">email</i>
                    </span>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}  label-floating ">
                        <label class="control-label">Correo Electronico</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}"
                               required>
                    </div>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                          @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>

                        @endif
                        @if (session('status'))
                            <div class="help-block">
                                 {{ session('status') }}
                             </div>
                        @endif
                    </span>
                </div>

            </div>

            <div class="footer text-center">
                <button type="submit" class="btn btn-rose">
                    Enviar enlace de recuperación
                </button>
            </div>
        </div>
    </form>


@stop