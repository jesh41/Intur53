<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Annulment;
use App\City;
use App\Municipio;
use App\Catactivity;
use App\Cathotel;
use App\Hotel;
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
        //presenta un listado de usuarios
        $usuarios = User::all();
        $roles = Role::all();
        $departamento = City::all();
        $catho = Cathotel::all();
        $acti = Catactivity::all();
        return view("/admin/list")->with("usuarios", $usuarios)->with("roles", $roles)->with("depto", $departamento)->with("catho", $catho)->with("acti", $acti);
    }

    //funcion para desactivar usuarios
    public function desactivar_user(Request $request)
    {
        $iduser = $request->input("id_user");
        $usuario = User::find($iduser);
        $a = Auth::user()->id;
        if ($a == $iduser) {
            session()->put('error', 'No puede desactivar su mismo usuario');
        } else {
            $usuario->active = 0;
            $usuario->save();
            session()->put('success', 'Usuario desactivado');
        }

        return back();
    }

    //funcion para activar usuarios
    public function activar_user(Request $request)
    {
        $iduser = $request->input("id_user");
        $usuario = User::find($iduser);
        $a = Auth::user()->id;
        if ($a == $iduser) {
            session()->put('error', 'No puede activar su mismo usuario');
        } else {
            $usuario->active = 1;
            $usuario->save();
            session()->put('success', 'Usuario activado');
        }

        return back();
    }


	//crea un nuevo usuario
	public function crear_usuario(Request $request){
        //$reglas = ['email' => 'required|email|unique:users',];
        //  $mensajes = ['email.unique' => 'El email ya se encuentra registrado',];
        //    $validator = Validator::make($request->all(), $reglas, $mensajes);
        //    if ($validator->fails()) {
        //      session()->put('error', 'El email ya se encuentra registrado');
        //       return back()->withErrors($validator->errors());;
        //    }
        $this->validate($request, [
            'email' => 'required|email|unique:users',
        //    'telefono' => 'required|regex:/(01)[0-9]{9}/',
        ]);
        //test
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
                //$hotel->id_city = $request->input("departamento");
            $hotel->id_municipio = $request->input("municipio");
            $hotel->id_cathotel = $request->input("categoria");
            $hotel->id_catactivity = $request->input("actividad");
            $hotel->id_user = $ultimo;
                if ($hotel->save()) {
                    //asignacion rol
                    $usuario = User::find($ultimo);
                    $usuario->assignRole($request->input("tipo-usuario"));
                    session()->put('success', 'HOTEL REGISTRADO');

                    return back();
                } else {

                    session()->put('error', 'OCURRIO UN PROBLEMA CONTACTAR AL ADMINISTRADOR');

                    return back();
                }
            } else {
                //asignacion rol
                $usuario = User::find($ultimo);
                $usuario->assignRole($request->input("tipo-usuario"));
                session()->put('success', 'USUARIO REGISTRADO');

                return back();

            }
    } else {
            session()->put('error', 'OCURRIO UN PROBLEMA CONTACTAR AL ADMINISTRADOR');

            return back();
        }

	}

    public function editar_usuario_admin(Request $request)
    {
        $idusuario=$request->input("id_usuario");
        $rol = $request->input("id_rol");
        $usuario=User::find($idusuario);
        $rolesasignados = $usuario->getRoles();
        if (! empty($rolesasignados)) {
            if ($rolesasignados[0] != 'administrador') {
                $usuario->revokeAllRoles();
                $usuario->assignRole($rol);
                $usuario->save();
                session()->put('success', 'USUARIO ACTUALIZADO');
                return back();
            } else {
                session()->put('warning', 'NO SE PUEDE CAMBIAR ROL ADMINISTRADOR');
                return back();
            }
        } else {
            $usuario->revokeAllRoles();
            $usuario->assignRole($rol);
            $usuario->save();
            session()->put('success', 'USUARIO ACTUALIZADO');
            return back();
        }
    }

    //cambio pass
    public function edit_pass(Request $request)
    {
        $actual = $request->input("old");
        $nuevo = $request->input("password");
        $confi = $request->input("password_confirmation");
        $a = Auth::user()->id;
        $usuario = User::find($a);
        if ($nuevo == $confi && Hash::check($actual, $usuario->password)) {
            $usuario->password = bcrypt($nuevo);
            $usuario->save();
            session()->put('success', 'Contraseña actualizada');
        } else {
            session()->put('error', 'Contraseña no coinciden');
        }
        return back();
    }

    public function edit_info(Request $request)
    {
        //$reglas = ['email' => 'required|email|unique:users',];
        //  $mensajes = ['email.unique' => 'El email ya se encuentra registrado',];
        //    $validator = Validator::make($request->all(), $reglas, $mensajes);
        //    if ($validator->fails()) {
        //      session()->put('error', 'El email ya se encuentra registrado');
        //       return back()->withErrors($validator->errors());;
        //    }

        $actual = $request->input("password");
        $correo = $request->input("email");
        $nombre = $request->input("name");
        $a = Auth::user()->id;
        $usuario = User::find($a);

        if (Hash::check($actual, $usuario->password)) {
            if ($usuario->email == $correo) {
                $usuario->name = $nombre;
                $usuario->save();
                session()->put('success', 'Datos Actualizados');
            }
            $usuario->name = $nombre;
            $usuario->email = $correo;
            $usuario->save();
            session()->put('success', 'Datos Actualizados');

        } else {
            session()->put('error', 'Contraseña no coincide');
        }

        return back();
    }




	//funciones para roles

	//carga el formulario para agregar un nuevo rol
    public function rolindex()
    {
        $roles = Role::all();
        $permisos = Permission::all();
        return view("admin.roles")->with("roles", $roles)->with("permisos", $permisos);
	}
	//metodo crear rol
	public function crear_rol(Request $request){
   $rol=new Role;
   $rol->name=$request->input("rol_nombre") ;
   $rol->slug=$request->input("rol_slug") ;
   $rol->description=$request->input("rol_descripcion") ;
    if($rol->save())
    {
        session()->put('success', 'ROL CREADO');

        return back();

    }
    else
    {
        session()->put('error', 'HA OCURRIDO UN PROBLEMA');

        return back();

    }
	}

	//borrado rol
	public function borrar_rol($idrole){
    $role = Role::find($idrole);
    $role->delete();
    return "ok";
	}



	//funciones para permisos

    public function crear_permiso(Request $request){
   $permiso=new Permission;
   $permiso->name=$request->input("permiso_nombre") ;
   $permiso->slug=$request->input("permiso_slug") ;
   $permiso->description=$request->input("permiso_descripcion") ;
    if($permiso->save())
    {
        session()->put('success', 'PERMISO CREADO');

        return back();
    }
    else
    {
        session()->put('error', 'HA OCURRIDO UN PROBLEMA');

        return back();
    }
	}

	public function asignar_permiso(Request $request){

     $roleid=$request->input("rol_sel");
     $idper=$request->input("permiso_rol");
     $rol=Role::find($roleid);
        $permiso = Permission::find($idper);
        $actual = $rol->getPermissions();
        if (! empty($actual)) {
            if ($permiso->slug == $actual[0]) {
                session()->put('error', 'YA POSEE ESE PERMISO');

                return back();
            }
        }

     $rol->assignPermission($idper);
    
    if($rol->save())
    {
        session()->put('success', 'PERMISO ASIGNADO');

        return back();

    }
    else
    {
        session()->put('error', 'HA OCURRIDO UN PROBLEMA');

        return back();
    }
    }

    public function quitar_permiso(Request $request)
    {

        $role = Role::find($request->input("id_rol"));
        $role->revokePermission($request->input("id_permiso"));
        if ($role->save()) {
            session()->put('success', 'PERMISO ELIMINADO');
        return back();
        } else {
            session()->put('error', 'HA OCURRIDO UN ERROR');

            return back();
        }
	}



//bitacora
     public function bitacora()
    {
        $annulments = Annulment::all();
        $year=date("Y");
        $detalle = DB::select("call dash($year)");
        $detalle2 = DB::select("call anulaciones_anual($year)");
        $ro = Role::where('name', 'LIKE', "%".'otel'."%")->get()->first();
        $ro = $ro->id;
        $thoteles = DB::select("call count_user_rol($ro)");
        $thoteles = $thoteles[0]->conteo;
        if (empty($thoteles)) {
            $thoteles = 0;
        }
        return view('/admin/bitacora')->with("annulments",$annulments)->with("data", $detalle)->with("year", $year)->with("TH", $thoteles)->with("data2",$detalle2);
    }

    //usuario
    public function edituser()
    {
        $usuario = User::find(Auth::user()->id);
        $indicador = false;
        $hotel = Hotel::where('id_user', '=', $usuario->id)->get()->first();
        if (Auth::user()->isRole('hotel') && ! empty($hotel)) {
            $datos = Hotel::find($usuario->hotel->id);
            $indicador = true;
            return view('admin.edit')->with('h', $datos)->with('u', $usuario)->with('indicador', $indicador);
        } else {

            return view('admin.edit')->with('u', $usuario)->with('indicador', $indicador);
        }
    }
}
