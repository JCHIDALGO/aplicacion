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

Route::get('/', function () {     return view('welcome'); });
Route::resource('Embarazadas','EmbaradasController');
Route::resource('Puerperas','PuerperasController');
Route::get('DetalleEmbarazada/{expediente}','EmbaradasController@detalle');
Route::get('Riesgo','EmbaradasController@riesgo');
Route::get('Edad/{from}/{to}','EmbaradasController@edad');
Route::get('Embarazadas/Municipio/{}','EmbaradasController@municipio');
