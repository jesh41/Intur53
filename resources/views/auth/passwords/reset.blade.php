@extends('layouts.login')

@section('content')

                        <form class="form-signin" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
                            <div class="card card-login card-hidden">
                                <div class="card-header text-center" data-background-color="rose">
                                    <h4 class="card-title">Recuperar tu contraseña</h4>
                                </div>
                            <input type="hidden" name="token" value="{{ $token }}">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                          <i class="material-icons">email</i>
                                    </span>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}  label-floating ">
                                        <label class="control-label">Correo Electronico</label>
                                        <input id="email" name="email" type="email" class="form-control"
                                               value="{{ $email or old('email') }}" required>
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
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}  label-floating ">
                                        <label class="control-label">Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>
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

                                <div class="input-group">
                                    <span class="input-group-addon">
                                          <i class="material-icons">lock_outline</i>
                                    </span>
                                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}  label-floating ">
                                        <label class="control-label">Confirmar Contraseña</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="input-group">
                                 <span class="input-group-addon">
                                  @if ($errors->has('password_confirmation'))
                                         <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                     @endif
                                 </span>
                                </div>


                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-rose">
                                        Recuperar Contraseña
                                    </button>
                                </div>
                            </div>
                        </form>

@endsection