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
	Route::get('/admin', 'HomeController@listadouser');
	///Modulo Book
	Route::get('/book','BookController@index');
	//modulo reporteria
	Route::get('/report','ReportController@index');
  
   

});
