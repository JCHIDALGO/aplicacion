<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//ruta que viene por default en laravel la comentaremos
//Route::get('/', function () {     return view('welcome'); });
//obtener todas las embarazadas
Route::resource('Embarazadas','EmbaradasController');

//Obtener todas las puerperas
Route::resource('Puerperas','PuerperasController');

Route::resource('distintas','EmbaradasController@censadas_unidad');

// en esta query se obtiene todas las embarada en base al expeiente pasado como parametro
Route::get('DetalleEmbarazada/{expediente}','EmbaradasController@detalle');

// con esta ruta obtenemos el numero de riesgo bajo,medio,alto
Route::get('Riesgo','EmbaradasController@riesgo');

//ruta para obtener embarazadas en base a rango de edad
Route::get('Edad/{from}/{to}','EmbaradasController@edad');

// en esta ruta obtenemos todas las embarazadas por el municpio pasado como parametro
Route::get('Embarazadas/Municipio/{municipio}','EmbaradasController@municipio');
//retornar todos los municipios que se encuentra en la tabla tembarzadas
Route::get('Municipios','EmbaradasController@todos');

Route::get('Embarazadas/36semanas','EmbaradasController@semanas');
