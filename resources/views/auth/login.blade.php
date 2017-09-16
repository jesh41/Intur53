@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h2 class="text-center">Iniciar Sesión</h2>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-signin" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">Correo electrónico</label>
                                <div>
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" placeholder="user@example.com" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Contraseña</label>
                                <div>
                                    <input id="password" type="password" class="form-control" name="password"
                                           placeholder="*******" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar mis
                                            datos
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success outline btn-block">
                                    Iniciar
                                </button>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Has olvidado tu contraseña?
                                </a>
                            </div>
                        </form>
                    </div>
                <!-- <div class="panel-footer text-center">
                        <a class="btn btn-link" href="{{ route('register') }}">
                            Solicita tu cuenta de usuario!
                        </a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
@endsection