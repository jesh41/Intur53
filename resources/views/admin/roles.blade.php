@extends('layouts.new')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">face</i> <h4 class="card-title">ROLES Y PERMISOS</h4>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#adduser">
                                <i class="material-icons">person_add</i>CREAR RELACION
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
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="">
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
                            <div class="card-header card-header-icon" data-background-color="rose">
                                <i class="material-icons">face</i> <h4 class="card-title">ROLES</h4>
                            </div>

                            <div>
                                <button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#adduser">
                                    <i class="material-icons">person_add</i>Agregar
                                    Rol
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
                            <div class="card-header card-header-icon" data-background-color="rose">
                                <i class="material-icons">face</i><h4 class="card-title">PERMISOS</h4>
                            </div>

                            <div>
                                <button class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#adduser">
                                    <i class="material-icons">person_add</i>Agregar
                                    Permiso
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
                                                        <span class="label label-default">{{ $permiso->name or "Ninguno" }}</span>
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