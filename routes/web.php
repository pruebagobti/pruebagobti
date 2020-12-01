<?php

/*
|----------------------------------------	----------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','PanelControlController@index')->name('InicioPanelControl');


Route::get('/InicioProducto','ProductoController@index')->name('InicioProducto');
Route::get('/NuevoProducto','ProductoController@create')->name('NuevoProducto');
Route::post('/GuardarProducto','ProductoController@store')->name('GuardarProducto');
Route::get('/EditarProducto/{id}','ProductoController@edit')->name('EditarProducto');
Route::post('/ModificarProducto','ProductoController@update')->name('ModificarProducto');
Route::get('/EliminarProducto/{id}','ProductoController@destroy')->name('EliminarProducto');

Route::get('/InicioCategoria','CategoriaController@index')->name('InicioCategoria');
Route::post('/GuardarCategoria','CategoriaController@store')->name('GuardarCategoria');
Route::get('/EliminarCategoria/{id}','CategoriaController@eliminaCategoria');
Route::get('/ModificaCategoria/{id}','CategoriaController@edit');
Route::post('/GuardarModificacionCategoria','CategoriaController@update')->name('GuardarModificacionCategoria');

Route::get('/InicioGrafica','GraficaController@index')->name('InicioGrafica');
Route::get('/listaProducto','GraficaController@listaProducto')->name('listaProducto');
Route::post('/GuardarProductoAjax','GraficaController@GuardarProductoAjax')->name('GuardarProductoAjax');

Route::get('/CrearQrPng','QRController@CrearQrPng')->name('CrearQrPng');
Route::get('/qrproducto','QRController@qrproducto')->name('qrproducto');
Route::get('/ListaProductosQR','QRController@ListaProductosQR')->name('ListaProductosQR');
Route::get('/DescargarQrPng','QRController@DescargarQrPng')->name('DescargarQrPng');

Route::get('/IndexGL','GuzzleLaravelController@IndexGL')->name('IndexGL');
Route::get('/showGL/{id}','GuzzleLaravelController@showGL')->name('showGL');
