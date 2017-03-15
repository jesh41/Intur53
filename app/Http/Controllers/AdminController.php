<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
  

     public function listadouser()
    {
        return view('/admin/list');
    }
    
    public function listado_usuarios()
    {
    //presenta un listado de usuarios paginados de 25 a 25
    $usuarios=User::paginate(25);
    return view("/admin/list")->with("usuarios",$usuarios);
    }
    //formulario nuevo usuario
    public function form_nuevo_usuario(){
    //carga el formulario para agregar un nuevo usuario
   $roles=Role::all();
    return view("formularios.form_nuevo_usuario")->with("roles",$roles);
	}



	//
	public function crear_usuario(Request $request){
    //crea un nuevo usuario en el sistema

	$reglas=[  'password' => 'required|min:8',
	             'email' => 'required|email|unique:users', ];
	 
	$mensajes=[  'password.min' => 'El password debe tener al menos 8 caracteres',
	             'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];
	  
	$validator = Validator::make( $request->all(),$reglas,$mensajes );
	if( $validator->fails() ){ 
	  	return view("mensajes.mensaje_error")->with("msj","...Existen errores...")
	  	                                    ->withErrors($validator->errors());         
	}

	$usuario=new User;
	$usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
	
	
	$usuario->email=$request->input("email");
	$usuario->password= bcrypt( $request->input("password") ); 
 
            
    if($usuario->save())
    {

  
      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

}




}
