@extends('layouts.new')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

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
                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead role="row" class="odd">
                                        <tr>
                                            <th>codigo</th>
                                            <th>nombre</th>
                                            <th>slug</th>
                                            <th>descripcion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $rol)
                                            <tr role="row" class="odd" id="filaR_{{  $rol->id }}">
                                                <td>{{ $rol->id }}</td>
                                                <td>
                                                    <span class="label label-default">{{ $rol->name or "Ninguno" }}</span>
                                                </td>
                                                <td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"
                                                                                             style="display:block"><i
                                                                class="fa fa-user"></i>&nbsp;&nbsp;{{ $rol->slug  }}</a>
                                                </td>
                                                <td>{{ $rol->description }}</td>
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
                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <th>codigo</th>
                                        <th>nombre</th>
                                        <th>slug</th>
                                        <th>descripcion</th>
                                        </thead>
                                        <tbody>
                                        @foreach($permisos as $permiso)
                                            <tr role="row" class="odd" id="filaP_{{ $permiso->id }}">
                                                <td>{{ $permiso->id }}</td>
                                                <td>
                                                    <span class="label label-default">{{ $permiso->name or "Ninguno" }}</span>
                                                </td>
                                                <td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"
                                                                                             style="display:block"></i>&nbsp;&nbsp;{{ $permiso->slug  }}</a>
                                                </td>
                                                <td>{{ $permiso->description }}</td>
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



@endsection