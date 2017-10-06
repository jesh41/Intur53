@extends('layouts.new')
@section('content')

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
                            <button href="javascript:void(0);" class="btn btn-primary btn-sm btn-round"
                                    onclick="cargar_formulario(1);"><i class="material-icons">person_add</i>Agregar
                                Usuario
                            </button>
                            <button href="javascript:void(0);" class="btn btn-primary btn-sm btn-round"
                                    onclick="cargar_formulario(2);">Roles
                            </button>
                            <button href="javascript:void(0);" class="btn btn-primary btn-sm btn-round"
                                    onclick="cargar_formulario(3);">Permisos
                            </button>
                        </div>

                        <div class="card-content">

                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">
                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead role="row" class="text-primary">
                                        <tr>
                                            <th>codigo</th>
                                            <th>Rol</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th class="text-right">Acción</th>
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
                                                <td class="td-actions text-right">

                                                    <button type="button" class="btn  btn-default btn-xs"
                                                            onclick="verinfo_usuario({{  $usuario->id }})"><i
                                                                class="fa fa-fw fa-edit"></i></button>
                                                    <button type="button" class="btn  btn-danger btn-xs"
                                                            onclick="borrado_usuario({{  $usuario->id }});"><i
                                                                class="fa fa-fw fa-remove"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $usuarios->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection