@extends('layouts.new')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">PANEL DE ROLES</h4>
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
                            <i class="material-icons">face</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">PANEL DE PERMISOS</h4>
                            <div class="tab-content">
                                <div class="tab-pane active table-responsive">
                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <th colspan="5" style="text-align: center; background-color: #b8ccde;">Permisos
                                            del Usuario {{ $rol->name }}</th>
                                        </thead>
                                        <thead>
                                        <th>codigo</th>
                                        <th>nombre</th>
                                        <th>slug</th>
                                        <th>descripcion</th>
                                        </thead>
                                        <tbody>
                                        @foreach($rol->permissions as $permiso)
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