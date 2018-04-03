@extends('layouts.new')
@section('content')
    <!-- add usuario Modal -->
    <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-signup">
            <div class="modal-content">
                <div class="card card-signup card-plain" data-background-color="red">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        <div class="card-header  text-center " data-background-color="purple">
                            <h4 class="card-title">Crear Usuario</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/crear_usuario" id="f_cargar_books" class="formarchivo"
                              enctype="multipart/form-data">
                            <div class="card-content">

                                <div class="col-md-6">

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


                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">vpn_key</i>
                                        </span>
                                        <input type="password" class="form-control" id="password"
                                               placeholder="contraseña" name="password" required>
                                    </div>


                                    <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">accessibility</i>
                                        </span>
                                        <select class="btn btn-primary btn-round" id="tipo-usuario" name="tipo-usuario"
                                                required>
                                            <option value="" selected disabled>Tipo Usuario</option>
                                            @foreach($roles as $role)
                                                <option value={{$role->id}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group" id="text-departamento" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">home</i>
                                        </span>
                                        <select class="btn btn-primary btn-round" id="departamento" name="departamento">
                                            <option value="" selected disabled>Departamento</option>
                                            @foreach ($depto as $d)
                                                <option value={{$d->id}}>{{$d->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>


                                <div class="col-md-6">


                                    <div class="input-group" id="text-municipio" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">store</i>
                                        </span>
                                        <select class="btn btn-primary btn-round" id="municipio" name="municipio">
                                            <option value="" selected disabled>Municipio</option>
                                        </select>
                                    </div>


                                    <div class="input-group" id="text-actividad" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">local_activity</i>
                                        </span>
                                        <select class="btn btn-primary btn-round" id="actividad" name="actividad">
                                            <option value="" selected disabled>Actividad</option>
                                            @foreach ($acti as $ac)
                                                <option value={{$ac->id}}>{{$ac->actividad}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="input-group" id="text-categoria" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">stars</i>
                                        </span>
                                        <select class="btn btn-primary btn-round" id="categoria" name="categoria">
                                            <option value="" selected disabled>Categoria</option>
                                            @foreach ($catho as $cath)
                                                <option value={{$cath->id}}>{{$cath->categoria}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="input-group" id="text-nombre" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">account_circle</i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nombre Hotel"
                                               id="nombre-hotel" name="nombre-hotel">
                                    </div>


                                    <div class="input-group" id="text-telefono" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">phone</i>
                                        </span>
                                        <input type="tel" class="form-control" placeholder="Telefono" id="telefono"
                                               name="telefono">
                                    </div>


                                </div>
                                <div class="input-group" id="text-direc" style="visibility:hidden">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">edit_location</i>
                                        </span>
                                    <textarea class="form-control" rows="2" placeholder="Direccion" id="direccion"
                                              name="direccion" maxlength="120"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer text-center">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <button type="submit" class="btn btn-primary ">Crear Usuario
                                </button>
                                <a class="btn btn-primary btn-simple btn-wd btn-lg" data-dismiss="modal"
                                   aria-hidden="true">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  End Modal -->

    <!-- cambio rol Modal -->
    <div class="modal fade" id="cambiorol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-rol">
            <div class="modal-content">
                <div class="card card-signup card-plain" data-background-color="red">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        <div class="card-header  text-center " data-background-color="purple">
                            <h4 class="card-title">Cambio rol </h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="cambiorol" id="form_cambio_rol" class="formarchivo"
                              enctype="multipart/form-data">
                            <div class="card-content">


                                <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">accessibility</i>
                                        </span>
                                    <select class="btn btn-primary btn-round" id="id_rol" name="id_rol"
                                            required>
                                        <option value="" selected disabled>Rol</option>
                                        @foreach($roles as $role)
                                            <option value={{$role->id}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="modal-footer text-center">
                            <!--<input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">-->
                                <button type="submit" class="btn btn-primary ">Asignar
                                </button>
                                <a class="btn btn-primary btn-simple btn-wd btn-lg" data-dismiss="modal"
                                   aria-hidden="true">Cancelar</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--  End Modal -->



    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">people</i> <h4 class="card-title">Usuarios</h4>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#adduser">
                                <i class="material-icons">person_add</i>Agregar
                                Usuario
                            </button>

                        </div>

                        <div class="card-content">

                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead role="row" class="text-primary">
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th>Rol</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr role="row" class="odd">
                                                <td>{{ $usuario->id }}</td>
                                                <td><span class="label label-default">

                                                 @foreach($usuario->getRoles() as $roles)
                                                            {{  $roles.","  }}
                                                        @endforeach

                                                    </span>
                                                </td>
                                                <td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"
                                                                                             style="display:block"><i
                                                                class="fa fa-user"></i>&nbsp;&nbsp;{{ $usuario->name  }}
                                                    </a></td>
                                                <td>{{ $usuario->email }}</td>
                                                <td class="td-actions text-centert">

                                                <!--   <button type="button" class="btn  btn-info btn-xs"
                                                            title="Cambiar rol"
                                                            onclick="material.enviar({{ $usuario->id }})"
                                                            data-toggle="modal" data-target="#cambiorol"><i
                                                                class="material-icons">mode_edit</i></button>-->
                                                    @if ($usuario->active==1)
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                title="desactivar"
                                                                onclick="material.showSwal('desactivar','{{$usuario->id }}','<?php echo csrf_token(); ?>')">
                                                            <i class="material-icons">clear</i></button>
                                                    @else
                                                        <button type="button" class="btn btn-success btn-sm"
                                                                title="activar"
                                                                onclick="material.showSwal('activar','{{$usuario->id }}','<?php echo csrf_token(); ?>')">
                                                            <i class="material-icons">done</i></button>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection