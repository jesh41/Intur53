@extends('layouts.new')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">info</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">INFORMACION DE LA CUENTA</h4>
            <div class="panel-body">
                <div class="col-md-6">
                    Nombre: {{$u->name}}
                </div>
                <div class="col-md-6">
                    Correo: {{$u->email}}
                </div>
                <div class="col-md-6">
                    @foreach($u->getRoles() as $roles)
                        Tipo de usuario:  {{  $roles }}
                    @endforeach
                </div>
                @if(Auth::user()->isRole('hotel')&& $indicador==true)
                    <div class="col-md-6">
                        Hotel:{{$h->nombre}}
                    </div>
                    <div class="col-md-6">
                        Categoria: {{$h->cathotel->categoria}}
                    </div>

                    <div class="col-md-6">
                        Departamento: {{$h->city->city}}
                    </div>
                    <div class="col-md-6">
                        Municipio: {{$h->municipio->municipio}}
                    </div>

                    <div class="col-md-6">
                        Actividad: {{$h->catactivity->actividad}}
                    </div>
                @endif
            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-md-offset-1">
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-header card-header-icon" data-background-color="rose">
                                <i class="material-icons">update</i>
                            </div>
                            <form method="post" action="/editar_pass" enctype="multipart/form-data">
                                <div class="card-content">
                                    <h4 class="card-title">Cambiar contraseña</h4>
                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">vpn_key</i>
                                        </span>
                                        <input type="password" class="form-control" id="old"
                                               placeholder="contraseña actual" name="old" required>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">vpn_key</i>
                                        </span>
                                        <input type="password" class="form-control" id="password"
                                               placeholder="nueva contraseña" name="password" required>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">vpn_key</i>
                                        </span>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               placeholder="repetir contraseña" name="password_confirmation" required>
                                    </div>


                                    <div class="footer text-center">
                                        <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                        <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>


                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="rose">
                                <i class="material-icons">update</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Actualizar datos</h4>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong><br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="post" action="/editar_info" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">email</i>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="correo" required>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">person_pin</i>
                                        </span>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="nombre" required>
                                    </div>

                                    <!--      <div class="input-group" id="text-telefono">
                                              <span class="input-group-btn input-group-s">
                                                  <i class="material-icons">phone</i>
                                              </span>
                                              <input type="tel" class="form-control" placeholder="Telefono" id="telefono"
                                                     name="telefono">
                                          </div>
                                          -->
                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">vpn_key</i>
                                        </span>
                                        <input type="password" class="form-control" id="password"
                                               placeholder="contraseña actual" name="password" required>
                                    </div>

                                    <div class="footer text-center">
                                        <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                        <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection