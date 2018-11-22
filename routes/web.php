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
    return view('welcome');
});

/* con QueryBuilder */
Route::get('/datos/lista/{accion?}', 'DatoController@lista')
    ->name('datos_lista');
Route::get('/datos/detalle/{id?}', 'DatoController@detalle')
    ->name('datos_detalle');

Route::get('/datos/nuevo', 'DatoController@nuevo')
    ->name('datos_nuevo');
Route::post('/datos/insertar', 'DatoController@insertar')
    ->name('datos_insertar');

Route::post('/datos/editar', 'DatoController@editar')
    ->name('datos_editar');
Route::get('/datos/editar/{id}/{campo}/{valor}', 'DatoController@editar_campo')
    ->name('datos_editar_campo');

Route::get('/datos/borrar/{id}', 'DatoController@borrar')
    ->name('datos_borrar');

/* con Eloquent */
Route::get('/datos-eloq/lista/{accion?}', 'DatoEloqController@lista')
    ->name('datos_eloq_lista');
Route::get('/datos-eloq/detalle/{id?}', 'DatoEloqController@detalle')
    ->name('datos_eloq_detalle');

Route::get('/datos-eloq/nuevo', 'DatoEloqController@nuevo')
    ->name('datos_eloq_nuevo');
Route::post('/datos-eloq/insertar', 'DatoEloqController@insertar')
    ->name('datos_eloq_insertar');

Route::post('/datos-eloq/editar', 'DatoEloqController@editar')
    ->name('datos_eloq_editar');
Route::get('/datos-eloq/editar/{id}/{campo}/{valor}', 'DatoEloqController@editar_campo')
    ->name('datos_eloq_editar_campo');

Route::get('/datos-eloq/borrar/{id}', 'DatoEloqController@borrar')
    ->name('datos_eloq_borrar');
