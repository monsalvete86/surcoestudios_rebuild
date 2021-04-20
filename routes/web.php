<?php


Route::get('/','HomeController@index');


Route::get('/home','HomeController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});

Route::get('oferta','HomeController@oferta');

Route::get('diplomados','HomeController@diplomados');

Route::get('dashboard','HomeController@dashboard');

Route::get('inscribirme/{id_curso}','HomeController@inscribirme');

Route::get('detalle/{id_curso}','HomeController@detalle');

Route::get('{path}','HomeController@index');
