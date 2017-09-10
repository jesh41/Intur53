<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Annulment;
use App\City;
use App\Municipio;
use App\Catactivity;
use App\Cathotel;
use App\hotel;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function listado_usuarios()
    {
    //presenta un listado de usuarios paginados de 25 a 25
    $usuarios=User::paginate(10);
    return view("/admin/list")->with("usuarios",$usuarios);
    }

    //formulario nuevo usuario
    public function form_nuevo_usuario(){
        //carga el formulario para agregar un nuevo usuario
        $roles = Role::all();
        $departamento = City::all();
        $catho = Cathotel::all();
        $acti = Catactivity::all();
        return view("formularios.form_nuevo_usuario")->with("roles", $roles)->with("depto", $departamento)->with("catho", $catho)->with("acti", $acti);
	}

	//crea un nuevo usuario
	public function crear_usuario(Request $request){

        $this->validate($request, [
            'email' => 'required|email|unique:users',
        ]);

        $usuario=new User;
        $usuario->name = $request->input("name");
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        $bandera = Role::find($request->input("tipo-usuario"));
        if ($usuario->save()) {
            $ultimo = User::all()->pluck('id')->last();
            if ($bandera->name == 'hotel' || $bandera->name == 'Hotel') {

                $hotel = new hotel;
            $hotel->nombre = $request->input("nombre-hotel");
            $hotel->direccion = $request->input("direccion");
            $hotel->telefono = $request->input("telefono");
            $hotel->id_city = $request->input("departamento");
            $hotel->id_municipio = $request->input("municipio");
            $hotel->id_cathotel = $request->input("categoria");
            $hotel->id_catactivity = $request->input("actividad");
            $hotel->id_user = $ultimo;
                if ($hotel->save()) {
                    //asignacion rol
                    $usuario = User::find($ultimo);
                    $usuario->assignRole($request->input("tipo-usuario"));
                    $notificacion = [
                        'message' => 'Hotel guardado',
                        'alert-type' => 'success',
                    ];

                    return back()->with($notificacion);
                } else {

                    $notificacion = [
                        'message' => 'Ha ocurrido un error',
                        'alert-type' => 'error',
                    ];

                    return back()->with($notificacion);
                }
            } else {
                //asignacion rol
                $usuario = User::find($ultimo);
                $usuario->assignRole($request->input("tipo-usuario"));
                $notificacion = [
                    'message' => 'Usuario guardado',
                    'alert-type' => 'success',
                ];

                return back()->with($notificacion);
                // return view('/home')->with($notificacion);
                //return view("mensajes.msj_usuario_creado")->with("msj", "Usuario agregado correctamente");
            }
    } else {

            $notificacion = [
                'message' => 'Ha ocurrido un error',
                'alert-type' => 'error',
            ];

            return back()->with($notificacion);
        }

	}

    //busqueda usuarios
	public function buscar_usuario(Request $request){
	$dato=$request->input("dato_buscado");
	$usuarios=User::where("name","like","%".$dato."%")->paginate(25);
	return view('admin.listado_usuarios')->with("usuarios",$usuarios);
      }

    public function form_editar_usuario($id){
    $usuario=User::find($id);
    $roles=Role::all();
    return view("formularios.form_editar_usuario")->with("usuario",$usuario)
	                                              ->with("roles",$roles);                                 
	}

	public function editar_usuario(Request $request){
          
    $idusuario=$request->input("id_usuario");
    $usuario=User::find($idusuario);
    $usuario->name=( $request->input("nombres") ) ;
 
    
     if($request->has("rol")){
	    $rol=$request->input("rol");
	    $usuario->revokeAllRoles();
	    $usuario->assignRole($rol);
     }
	 
    if( $usuario->save()){
		return view("mensajes.msj_usuario_actualizado")->with("msj","Usuario actualizado correctamente")
	                                                   ->with("idusuario",$idusuario) ;
    }
    else
    {
		return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
    }
	}
	//borrado usuario
	public function borrar_usuario(Request $request){
        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);
    
        if($usuario->delete()){
             return view("mensajes.msj_usuario_borrado")->with("msj","Usuario borrado correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
        }
        }
        
    public function form_borrado_usuario($id){
  $usuario=User::find($id);
  return view("formularios.form_borrado_usuario")->with("usuario",$usuario);
	}
	//accesso usuario correo y pass
	public function editar_acceso(Request $request){
         $idusuario=$request->input("id_usuario");
         $usuario=User::find($idusuario);
         $usuario->email=$request->input("email");
         $usuario->password= bcrypt( $request->input("password") ); 
          if( $usuario->save()){
        return view("mensajes.msj_usuario_actualizado")->with("msj","Usuario actualizado correctamente")->with("idusuario",$idusuario) ;
         }
          else
          {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ; intentarlo nuevamente ...") ;
          }
		}



	//funciones para roles

	//carga el formulario para agregar un nuevo rol
	public function form_nuevo_rol(){
    
    $roles=Role::all();
    return view("formularios.form_nuevo_rol")->with("roles",$roles);
	}
	//metodo crear rol
	public function crear_rol(Request $request){

   $rol=new Role;
   $rol->name=$request->input("rol_nombre") ;
   $rol->slug=$request->input("rol_slug") ;
   $rol->description=$request->input("rol_descripcion") ;
    if($rol->save())
    {
        return view("mensajes.msj_rol_creado")->with("msj","Rol agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
	}

	//borrado rol
	public function borrar_rol($idrole){

    $role = Role::find($idrole);
    $role->delete();
    return "ok";
	}

    //asignar rol
	public function asignar_rol($idusu,$idrol){

        $usuario=User::find($idusu);
        $usuario->assignRole($idrol);
        $usuario=User::find($idusu);
        $rolesasignados=$usuario->getRoles();
        return json_encode ($rolesasignados);
	}
	//quitar rol
	public function quitar_rol($idusu,$idrol){

    $usuario=User::find($idusu);
    $usuario->revokeRole($idrol);
    $rolesasignados=$usuario->getRoles();
    return json_encode ($rolesasignados);
	}









	//funciones para permisos
	public function form_nuevo_permiso(){
    //carga el formulario para agregar un nuevo permiso
     $roles=Role::all();
     $permisos=Permission::all();
    return view("formularios.form_nuevo_permiso")->with("roles",$roles)->with("permisos", $permisos);
	}

	public function crear_permiso(Request $request){

  
   $permiso=new Permission;
   $permiso->name=$request->input("permiso_nombre") ;
   $permiso->slug=$request->input("permiso_slug") ;
   $permiso->description=$request->input("permiso_descripcion") ;
    if($permiso->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso creado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
	}

	public function asignar_permiso(Request $request){

     $roleid=$request->input("rol_sel");
     $idper=$request->input("permiso_rol");
     $rol=Role::find($roleid);
     $rol->assignPermission($idper);
    
    if($rol->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso asignado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
    }
    public function quitar_permiso($idrole,$idper){ 
    
    $role = Role::find($idrole);
    $role->revokePermission($idper);
    $role->save();

    return "ok";
	}



//bitacora
     public function bitacora()
    {
        
        $annulments=Annulment::all();
        return view('/admin/bitacora')->with("annulments",$annulments);
    }

}
