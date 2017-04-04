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

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	//pagina inicio
	Route::get('/home', 'HomeController@index');
	//modulo administracion de usuarios
	Route::get('/listado_usuarios', 'AdminController@listado_usuarios');
	//creacion nuevo usuario
	Route::post('crear_usuario', 'AdminController@crear_usuario');
	Route::get('form_nuevo_usuario', 'AdminController@form_nuevo_usuario');
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

	 //modulo roles
	//roles creacion
	Route::post('crear_rol', 'AdminController@crear_rol');
	Route::get('form_nuevo_rol', 'AdminController@form_nuevo_rol');
	//rol borrado
	Route::get('borrar_rol/{idrol}', 'AdminController@borrar_rol');
	//asignar y quitar rol
	Route::get('asignar_rol/{idusu}/{idrol}', 'AdminController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'AdminController@quitar_rol');


	///Modulo Book
	Route::get('/book','BookController@index');

	Route::get('form_cargar_books', 'BookController@form_cargar_libros');
	Route::post('cargar_datos', 'BookController@cargar_libros');
	//anulacion
	Route::post('anular_libro', 'BookController@anular_libro');
	Route::get('confirmacion_anular_libro/{idusuario}', 'BookController@confirmacion_anular_libro');
	Route::get('form_anular_libro/{idusu}', 'BookController@form_anular_libro');

	//modulo reporteria
	Route::get('/reports','ReportController@index');
  	//
   

});
