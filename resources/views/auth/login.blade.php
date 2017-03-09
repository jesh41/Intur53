@extends('layouts.ini')

@section('content')
<div class="container">

<div class="row">
   <div class="login-logo" style="text-align:center;">
               <h1> <a href="{{ url('/home') }}"><b>Intur</b>2017</a> </h1> 
     </div>
</div>

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary" >

                <div class="panel-heading" style="text-align:center;">Inicia Session para acceder</div>
                <div class="panel-body">
                    <form class="form-horizontal"  role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico </label>

                            <div class="col-md-6">

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="correo"  required autofocus>
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">

                                <input id="password" type="password" class="form-control" name="password" placeholder="pass" required>


                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Olvido su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

