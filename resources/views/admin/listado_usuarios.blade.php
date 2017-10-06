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
                    <h4>Busqueda</h4>
                    <form action="{{ url('buscar_usuario') }}" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
                            <span class="input-group-btn">
					<input type="submit" class="btn btn-primary" value="buscar" >
					</span>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">people</i> <h4 class="card-title">Usuarios</h4>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary"
                               onclick="cargar_formulario(1);">Agregar Usuario</a>
                            <a href="{{ url("/listado_usuarios") }}" class="btn btn-xs btn-primary">Listado Usuarios</a>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary"
                               onclick="cargar_formulario(2);">Roles</a>
                            <a href="javascript:void(0);" class="btn btn-xs btn-primary"
                               onclick="cargar_formulario(3);">Permisos</a>
                        </div>

                        <div class="card-content">

                            <div class="tab-content">
                                <div class="tab-pane active table-responsive ">

                                    <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead role="row" class="text-primary">
						<tr>    <th>codigo</th>
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
            <td class="mailbox-messages mailbox-name"><a href="javascript:void(0);"  style="display:block"><i class="fa fa-user"></i>&nbsp;&nbsp;{{ $usuario->name  }}</a></td>
            <td>{{ $usuario->email }}</td>
            <td>
            
            <button type="button" class="btn  btn-default btn-xs" onclick="verinfo_usuario({{  $usuario->id }})" ><i class="fa fa-fw fa-edit"></i></button>
            <button type="button"  class="btn  btn-danger btn-xs"  onclick="borrado_usuario({{  $usuario->id }});"  ><i class="fa fa-fw fa-remove"></i></button>
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