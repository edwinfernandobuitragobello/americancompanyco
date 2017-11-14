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
Route::get('/','IndexController@index');
Route::get('/sub-categoria/{id?}','IndexController@index');
Route::get('/producto/{id?}','IndexController@producto');
Route::get('/contacto','IndexController@contacto');
Route::post('/contacto/enviar','IndexController@contacto_enviar');
Route::get('/preguntas_frecuentes','IndexController@preguntas_frecuentes');
Route::get('/sobre_nosotros','IndexController@sobre_nosotros');
Route::get('/productos','IndexController@productos_busqueda');
Route::post('/agregar_producto','IndexController@agregar_producto');
Route::get('/carrito_compras','IndexController@carrito_compras');

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

