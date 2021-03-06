@extends('layouts.login')
@section('pageTitle', 'Iniciar Sesión')
@section('content')

    <form class="form-signin" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="card card-login card-hidden">
            <div class="card-header text-center" data-background-color="blue2">
                <h4 class="card-title">Login</h4>
            </div>
            <div class="card-content">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-group  label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
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
                    </span>
                </div>


                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock_outline</i>
                    </span>
                    <div class="form-group label-floating {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="control-label">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                         @if ($errors->has('password'))
                            <span class="help-block">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </span>
                </div>


            </div>

            <div class="footer text-center">
                <button type="submit" class="btn btn-blue2 ">Iniciar sesion</button>
                <a class="btn btn-blue2 btn-simple btn-wd " href="{{ route('password.request') }}">
                    ¿Has olvidado tu contraseña?
                </a>
            </div>
        </div>
    </form>



@stop