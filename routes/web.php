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
    //modulo reporteria
    Route::get('/reports', 'ReportController@index');

    Route::group(['middleware' => 'roleshinobi:Administrador'], function () {
        Route::get('/listado_usuarios', 'AdminController@listado_usuarios');
        Route::post('/crear_usuario', 'AdminController@crear_usuario');
        route::get('/ajax-subcat', function () {
            $dep_id = Input::get('cat_id');
            $muni = \App\Municipio::where("id_city", "=", $dep_id)->get();
            return Response::json($muni);
        });
        //editar usuario
        Route::post('cambiorol', 'AdminController@editar_usuario_admin');
        //borrado usuario
        Route::post('borrar_usuario', 'AdminController@borrar_usuario');
        //editar acceso passs y correo desde su cuenta
        Route::post('/editar_pass', 'AdminController@edit_pass');
        Route::post('/editar_info', 'AdminController@edit_info');
        //modulo permisos
        Route::post('/crear_permiso', 'AdminController@crear_permiso');
        Route::post('/asignar_permiso', 'AdminController@asignar_permiso');
        Route::post('/quitar_permiso', 'AdminController@quitar_permiso');
        //roles
        Route::post('/crear_rol', 'AdminController@crear_rol');//->middleware('roleshinobi:Administrador')
        Route::get('/roles', 'AdminController@rolindex');
        //rol borrado
        Route::get('borrar_rol/{idrol}', 'AdminController@borrar_rol');
        //asignar y quitar rol

        //bitacora
        Route::get('/bitacora', 'AdminController@bitacora');
    });
//grupos
    Route::group(['middleware' => 'permissionshinobi:book'], function () {
        ///Modulo Book
        Route::get('/book', 'BookController@index');
        //descarga
        Route::get('descargar/{idusu}', 'BookController@descargar_libro');
    });

    Route::group(['middleware' => 'permissionshinobi:subir'], function () {
        Route::get('form_cargar_books', 'BookController@form_cargar_libros');
        Route::post('/cargar_datos', 'BookController@cargar_libros');
        Route::get('/anulados', 'BookController@anulados');
        Route::post('/anular_libro', 'BookController@anular_libro');

        route::get('/ajax-submes', function () {
            $año_seleccionado = Input::get('id');
            $usuario = Auth::user()->id;
            $mes_actual = date('m');

            if ($año_seleccionado == date('Y') && ! empty($año_seleccionado)) {
                $months = DB::select("call validacion_mes($año_seleccionado,$usuario,$mes_actual)");
            } else {
                if (! empty($año_seleccionado)) {
                    $months = DB::select("call validacion_anio($año_seleccionado,$usuario,$mes_actual)");
                }
            }
            if (empty($months)) {
                $months = null;
            }
            return Response::json($months);
        });
    });

    Route::group(['middleware' => 'permissionshinobi:reportes'], function () {

        //reporteria parametro
        Route::get('form_year/{tipo}', 'ReportController@form_year');
        //reporteria web
        Route::post('/reporte/{tipo}', 'ReportController@web_reporte');
        //modulo reporteria pdf
        Route::get('/crear_reporte_1/{tipo}/{anio}', 'ReportController@crear_reporte_porpais');
        Route::get('/reporte_exce_1/{anio}', 'ReportController@excel_reporte_1');
        Route::get('/reporte_exce_2/{anio}', 'ReportController@excel_reporte_2');
        Route::get('/reporte_exce_3/{anio}', 'ReportController@excel_reporte_3');
        Route::get('/reporte_exce_4/{anio}', 'ReportController@excel_reporte_4');

        Route::get('/crear_reporte_2/{tipo}/{anio}', 'ReportController@crear_reporte_por_sexo');
        Route::get('/crear_reporte_3/{tipo}/{anio}', 'ReportController@crear_reporte_por_region');
        Route::get('/crear_reporte_4/{tipo}/{anio}', 'ReportController@crear_reporte_por_estadia');
    });


});
