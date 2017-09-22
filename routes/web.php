<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Input;


Route::get('/', function () {
    if (Auth::guest()) {
        return view('/auth/login');
    } else {
        return view('home');
    }
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	//pagina inicio
	Route::get('/home', 'HomeController@index');
    Route::get('/user', 'AdminController@edituser');


    Route::group(['middleware' => 'roleshinobi:Administrador'], function () {
        Route::get('/listado_usuarios', 'AdminController@listado_usuarios');
        Route::post('/crear_usuario', 'AdminController@crear_usuario');
        Route::get('form_nuevo_usuario', 'AdminController@form_nuevo_usuario');

        route::get('/ajax-subcat', function () {
            $dep_id = Input::get('cat_id');
            $muni = \App\Municipio::where("id_city", "=", $dep_id)->get();
            return Response::json($muni);
        });
        //busqueda usuarios
        Route::post('buscar_usuario', 'AdminController@buscar_usuario');
        //editar usuario
        Route::post('editar_usuario', 'AdminController@editar_usuario');
        Route::get('form_editar_usuario/{id}', 'AdminController@form_editar_usuario');
        //borrado usuario
        Route::post('borrar_usuario', 'AdminController@borrar_usuario');
        Route::get('confirmacion_borrado_usuario/{idusuario}', 'AdminController@confirmacion_borrado_usuario');
        Route::get('form_borrado_usuario/{idusu}', 'AdminController@form_borrado_usuario');
        //editar acceso passs y correo
        Route::post('editar_acceso', 'AdminController@editar_acceso');
        //modulo permisos
        Route::post('crear_permiso', 'AdminController@crear_permiso');
        Route::get('form_nuevo_permiso', 'AdminController@form_nuevo_permiso');
        Route::post('asignar_permiso', 'AdminController@asignar_permiso');
        Route::get('quitar_permiso/{idrol}/{idper}', 'AdminController@quitar_permiso');
        //roles
        Route::post('crear_rol', 'AdminController@crear_rol');//->middleware('roleshinobi:Administrador')
        Route::get('form_nuevo_rol', 'AdminController@form_nuevo_rol');
        //rol borrado
        Route::get('borrar_rol/{idrol}', 'AdminController@borrar_rol');
        //asignar y quitar rol
        Route::get('asignar_rol/{idusu}/{idrol}', 'AdminController@asignar_rol');
        Route::get('quitar_rol/{idusu}/{idrol}', 'AdminController@quitar_rol');
        //bitacora
        Route::get('/bitacora', 'AdminController@bitacora');
    });
//grupos
    Route::group(['middleware' => 'permissionshinobi:book'], function () {
        ///Modulo Book
        Route::get('/book', 'BookController@index');
        //previ
        Route::get('form_prev_libro/{idusu}/{page?}', 'BookController@form_prev_libro');
        //descarga
        Route::get('descargar/{idusu}', 'BookController@descargar_libro');
    });

    Route::group(['middleware' => 'permissionshinobi:subir'], function () {
        Route::get('form_cargar_books', 'BookController@form_cargar_libros');
        Route::post('/cargar_datos', 'BookController@cargar_libros');
        Route::post('anular_libro', 'BookController@anular_libro');
        Route::get('form_anular_libro/{idusu}', 'BookController@form_anular_libro');
        route::get('/ajax-submes', function () {
            $año_seleccionado = Input::get('id');
            $usuario = Auth::user()->id;
            $mes_actual = date('m');
            if ($año_seleccionado == date('Y')) {
                $months = DB::select("call validacion_mes($año_seleccionado,$usuario,$mes_actual)");
            } else {
                $months = DB::select("call validacion_anio($año_seleccionado,$usuario,$mes_actual)");
            }

            return Response::json($months);
        });
    });

    Route::group(['middleware' => 'permissionshinobi:reportes'], function () {
        //modulo reporteria
        Route::get('/reports', 'ReportController@index');
        //reporteria parametro
        Route::get('form_year/{tipo}', 'ReportController@form_year');
        //reporteria web
        Route::post('/reporte/{tipo}', 'ReportController@web_reporte');
        //modulo reporteria pdf
        Route::get('/crear_reporte_1/{tipo}/{anio}', 'ReportController@crear_reporte_porpais');
        Route::get('/crear_reporte_2/{tipo}/{anio}', 'ReportController@crear_reporte_por_sexo');
        Route::get('/crear_reporte_3/{tipo}/{anio}', 'ReportController@crear_reporte_por_region');
        Route::get('/crear_reporte_4/{tipo}/{anio}', 'ReportController@crear_reporte_por_estadia');
    });


});
