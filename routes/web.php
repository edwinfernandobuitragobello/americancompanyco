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
Route::get('/{id?}','IndexController@index');

Route::get('/admin/categorias','AdministradorController@categorias');
Route::post('/admin/crear_categoria','AdministradorController@crear_categoria');
Route::post('/admin/editar_categoria','AdministradorController@editar_categoria');
Route::get('/admin/activar_categoria/{id?}','AdministradorController@activar_categoria');
Route::get('/admin/desactivar_categoria/{id?}','AdministradorController@desactivar_categoria');
Route::get('/admin/eliminar_categoria/{id?}','AdministradorController@eliminar_categoria');

Route::get('/admin/subCategorias','AdministradorController@subCategorias');
Route::post('/admin/crear_subCategorias','AdministradorController@crear_subCategorias');
Route::post('/admin/editar_subCategorias','AdministradorController@editar_subCategorias');
Route::get('/admin/activar_subCategorias/{id?}','AdministradorController@activar_subCategorias');
Route::get('/admin/desactivar_subCategorias/{id?}','AdministradorController@desactivar_subCategorias');
Route::get('/admin/eliminar_subCategorias/{id?}','AdministradorController@eliminar_subCategorias');

Route::get('/admin/productos','AdministradorController@productos');
Route::post('/admin/crear_producto','AdministradorController@crear_producto');
Route::post('/admin/editar_producto','AdministradorController@editar_producto');
Route::get('/admin/activar_producto/{id?}','AdministradorController@activar_producto');
Route::get('/admin/desactivar_producto/{id?}','AdministradorController@desactivar_producto');
Route::get('/admin/eliminar_producto/{id?}','AdministradorController@eliminar_producto');
Route::get('/admin/obtenerSubCategorias/{id?}','AdministradorController@obtenerSubCategorias');

Route::get('/pruebaformulario', function(){
	return view('form_category');
});
