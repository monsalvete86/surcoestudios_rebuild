<?php



use Illuminate\Http\Request;



/*php

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| is assigned the "api" middleware group. Enjoy building your API!

|

*/



Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});

Route::apiResources([
    'user'          => 'API\UserController', 
    'categoria'   => 'API\CategoriaController', 
    'empresa'     => 'API\EmpresaController', 
    'curso'       => 'API\CursoController', 
    'modulo'       => 'API\ModuloController', 
    'documento'       => 'API\DocumentoController', 
    'pregunta'       => 'API\PreguntaController', 
    'inscripcion'       => 'API\InscripcionController'
]);



Route::namespace('API')->group(function () {
    Route::get('profile', 'UserController@profile');
    Route::get('findUser', 'UserController@search');
    Route::get('getTutors', 'UserController@getTutors');
    Route::get('getModules/{id_curso}', 'ModuloController@getModules');
    Route::get('getResultModules/{id_inscripcion}/{id_curso}', 'ResultadoController@getResultModules');
    Route::get('getDocumentos/{id_modulo}', 'DocumentoController@getDocumentos');
    Route::get('getPreguntas/{id_modulo}', 'PreguntaController@getPreguntas');
    Route::get('getPreguntasArray/{id_modulo}', 'PreguntaController@getPreguntasArray');
    Route::get('borrarPregunta/{id_modulo}', 'PreguntaController@borrarPregunta');
    Route::put('profile', 'UserController@updateProfile');

    Route::get('inscribirme/{id_curso}', 'InscripcionController@inscribirme');
    Route::get('getInscripciones', 'InscripcionController@getInscripciones');
    Route::get('activaInscripcion/{id}', 'InscripcionController@activa');
    Route::get('findMisInscripciones', 'InscripcionController@findMisInscripciones');
    Route::get('cancelarMisInscripciones/{id}', 'InscripcionController@cancelarMisInscripciones');
    Route::post('crearInscripcion', 'InscripcionController@crearInscripcion');
    
    Route::get('findCategoria', 'CategoriaController@search');
    Route::get('findEmpresa', 'EmpresaController@search');
    Route::get('findCurso', 'CursoController@search');
    Route::get('listaCursos', 'CursoController@listaCursos');
    Route::get('findModulo', 'ModuloController@search');
    Route::get('findInscripcion', 'InscripcionController@search');

    Route::post('responderPreguntas', 'ResultadoController@responder');  
    Route::post('save_documento', 'DocumentoController@store');  
});