<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function() {
    Route::get('user/authenticated', 'UserController@authenticated');
    Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);
    Route::get('turma/getAll', 'TurmasController@getAll');
    Route::resource('turma', 'TurmasController', ['except' => ['create', 'edit']]);
    Route::get('aluno/cep/{cep}', 'AlunosController@cep');
    Route::resource('aluno', 'AlunosController', ['except' => ['create', 'edit']]);
    Route::resource('questionario', 'QuestionariosController', ['except' => ['create', 'edit']]);
    Route::post('questionario/{id}', 'QuestionariosController@update');
    Route::resource('pergunta', 'PerguntasController', ['except' => ['create', 'edit']]);
    Route::post('pergunta/{id}', 'PerguntasController@update');
});

