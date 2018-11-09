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

Route::redirect('/', '/home', 301);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aluno/create', 'AlunoController@create')->name('aluno.create');
Route::post('/aluno/store', 'AlunoController@store')->name('aluno.store');
Route::get('/aluno/list', 'AlunoController@list')->name('aluno.list');

Route::get('aluno/{aluno}',  ['as' => 'aluno.edit', 'uses' => 'AlunoController@edit']);
Route::post('aluno/update/{aluno}', 'AlunoController@update')->name('aluno.update');
// Route::patch('aluno/{aluno}/update',  ['as' => 'aluno.update', 'uses' => 'AlunoController@update']);


Route::get('/refeicao/create', 'RefeicaoController@create')->name('refeicao.create');
Route::post('/refeicao/store', 'RefeicaoController@store')->name('refeicao.store');
Route::get('/refeicao/list', 'RefeicaoController@list')->name('refeicao.list');
Route::get('refeicao/{refeicao}',  ['as' => 'refeicao.edit', 'uses' => 'RefeicaoController@edit']);
Route::post('refeicao/update/{refeicao}', 'RefeicaoController@update')->name('refeicao.update');


Route::post('/cupomalimentacao/store', 'CupomAlimentacaoController@store')->name('cupomalimentacao.store');
Route::get('/cupomalimentacao/today', 'CupomAlimentacaoController@today')->name('cupomalimentacao.today');
Route::get('cupomalimentacao/print/{cupomalimentacao}',  ['as' => 'cupomalimentacao.show', 'uses' => 'CupomAlimentacaoController@show']);

Route::get('/cupomalimentacao/validate', 'CupomAlimentacaoController@validateView')->name('cupomalimentacao.validate');
Route::post('/cupomalimentacao/validate', 'CupomAlimentacaoController@validateView')->name('cupomalimentacao.validate');
Route::post('/cupomalimentacao/dovalidate', 'CupomAlimentacaoController@doVAlidate')->name('cupomalimentacao.dovalidate');


// Route::get('cupomalimentacao/edit/{idCupom}',  ['as' => 'cupomalimentacao.edit', 'uses' => 'CupomAlimentacaoController@edit']);



Route::get('/escola/create', 'EscolaController@create')->name('escola.create');
Route::post('/escola/store', 'EscolaController@store')->name('escola.store');

Route::get('/restaurante/create', 'RestauranteController@create')->name('restaurante.create');
Route::post('/restaurante/store', 'RestauranteController@store')->name('restaurante.store');
