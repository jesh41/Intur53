@extends('layouts.new')
@section('content')

    <!-- rol Modal -->
    <div class="modal fade" id="RolModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-rol">
            <div class="modal-content">
                <div class="card card-signup card-plain" data-background-color="red">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        <div class="card-header  text-center " data-background-color="blue2">
                            <h4 class="card-title">Crear Rol</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/crear_rol" id="f_cargar_books" class="formarchivo"
                              enctype="multipart/form-data">
                            <div class="card-content">


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="rol_nombre" name="rol_nombre"
                                           placeholder="Nombre del rol" required>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="rol_slug" name="rol_slug"
                                           placeholder="Slug" required>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="rol_descripcion" name="rol_descripcion"
                                           placeholder="Descripcion" required>
                                </div>

                            </div>
                            <div class="modal-footer text-center">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <button type="submit" class="btn btn-blue2">Crear</button>
                                <a class="btn btn-blue2  btn-simple btn-wd btn-lg" data-dismiss="modal"
                                   aria-hidden="true">Cancelar</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--Permiso modal-->
    <div class="modal fade" id="PermisoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-rol">
            <div class="modal-content">
                <div class="card card-signup card-plain" data-background-color="red">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        <div class="card-header  text-center " data-background-color="blue2">
                            <h4 class="card-title">Crear Permiso</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/crear_permiso" class="formarchivo"
                              enctype="multipart/form-data">
                            <div class="card-content">


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="permiso_nombre" name="permiso_nombre"
                                           placeholder="Nombre del permiso" required>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="permiso_slug" name="permiso_slug"
                                           placeholder="Slug" required>
                                </div>


                                <div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">short_text</i>
								</span>
                                    <input type="text" class="form-control" id="permiso_descripcion"
                                           name="permiso_descripcion"
                                           placeholder="Descripcion" required>
                                </div>

                            </div>
                            <div class="modal-footer text-center">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <button type="submit" class="btn btn-blue2">Crear</button>
                                <a class="btn btn-blue2  btn-simple btn-wd btn-lg" data-dismiss="modal"
                                   aria-hidden="true">Cancelar</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!--Relacion modal-->
    <div class="modal fade" id="RelacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-rol">
            <div class="modal-content">
                <div class="card card-signup card-plain" data-background-color="red">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="material-icons">clear</i></button>
                        <div class="card-header  text-center " data-background-color="blue2">
                            <h4 class="card-title">Asignar permiso</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/asignar_permiso" class="formarchivo"
                              enctype="multipart/form-data">
                            <div class="card-content">

                                <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">verified_user</i>
                                        </span>
                                    <select class="btn btn-blue2 btn-round" id="rol_sel" name="rol_sel">
                                        <option value="" selected disabled>Rol</option>
                                        @foreach($roles as $rol)
                                            <option value={{$rol->id}}>{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="input-group">
                                        <span class="input-group-btn input-group-s">
											<i class="material-icons">group_work</i>
                                        </span>
                                    <select class="btn btn-blue2 btn-round" id="permiso_rol" name="permiso_rol">
                                        <option value="" selected disabled>Permiso</option>
                                        @foreach($permisos as $permiso)
                                            <option value={{$permiso->id}}>{{$permiso->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer text-center">
                                <input type="hidden" name="_token" id="_token" value="<?= csrf_token(); ?>">
                                <button type="submit" class="btn btn-blue2 ">Crear</button>
                                <a class="btn btn-blue2 btn-simple btn-wd btn-lg" data-dismiss="modal"
                                   aria-hidden="true">Cancelar</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>





    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="blue2">
                            <h4 class="card-title">ROLES Y PERMISOS</h4>
                        </div>
                        <div>
                            <button class="btn btn-blue2 btn-sm btn-round" data-toggle="modal"
                                    data-target="#RelacionModal">
                                CREAR RELACION
                            </button>
                        </div>

                        <div class="card-content">
                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                           cellspacing="0" width="100%" style="width:100%">
                                        <thead role="row" class="text-primary">
                                        <th>Rol</th>
                                        <th class="td-actions text-center">Permiso</th>
                                        <th class="td-actions text-center">descripcion</th>
                                        <td class="td-actions text-center">Accion
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $rol)
                                            @foreach($rol->permissions as $permiso)
                                                <tr role="row" class="odd" id="filaP_{{ $permiso->id }}">
                                                    <td>{{ $rol->name }}</td>
                                                    <td class="td-actions text-center"><span
                                                                class="label label-default">{{ $permiso->name or "Ninguno" }}</span>
                                                    </td>
                                                    <td class="td-actions text-center">{{ $permiso->description }}</td>
                                                    <td class="td-actions text-center">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="material.showSwal2('{{$rol->id  }}','{{ $permiso->id }}','<?php echo csrf_token(); ?>')">
                                                            <i class="material-icons">delete</i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-10 col-md-offset-1">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="blue2">
                                <h4 class="card-title">ROLES</h4>
                            </div>

                            <div>
                                <button class="btn btn-blue2 btn-sm btn-round" data-toggle="modal"
                                        data-target="#RolModal">
                                    Agregar Rol
                                </button>
                            </div>
                            <div class="card-content">

                                <div class="tab-content">

                                    <div class="tab-pane active table-responsive">
                                        <table id="datatables2"
                                               class="table table-striped table-no-bordered table-hover"
                                               cellspacing="0" width="100%" style="width:100%">
                                            <thead role="row" class="odd">
                                            <tr>
                                                <th>nombre</th>
                                                <th class="td-actions text-center">descripcion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($roles as $rol)
                                                <tr role="row" class="odd" id="filaR_{{  $rol->id }}">

                                                    <td>
                                                        <span class="label label-default">{{ $rol->name or "Ninguno" }}</span>
                                                    </td>

                                                    <td class="td-actions text-center">{{ $rol->description }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="blue2">
                                <h4 class="card-title">PERMISOS</h4>
                            </div>

                            <div>
                                <button class="btn btn-blue2 btn-sm btn-round" data-toggle="modal"
                                        data-target="#PermisoModal">
                                    Agregar Permiso
                                </button>
                            </div>
                            <div class="card-content">

                                <div class="tab-content">
                                    <div class="tab-pane active table-responsive">
                                        <table id="datatables3"
                                               class="table table-striped table-no-bordered table-hover"
                                               cellspacing="0" width="100%" style="width:100%">
                                            <thead>
                                            <th>nombre</th>
                                            <th class="td-actions text-center">descripcion</th>
                                            </thead>
                                            <tbody>
                                            @foreach($permisos as $permiso)
                                                <tr role="row" class="odd" id="filaP_{{ $permiso->id }}">
                                                    <td>
                                                        <span class="label label-default">{{ $permiso->name}}</span>
                                                    </td>
                                                    <td class="td-actions text-center">{{ $permiso->description }}</td>
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