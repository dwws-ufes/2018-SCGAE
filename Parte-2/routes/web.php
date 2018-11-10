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

Route::resource('aluno', 'AlunoController');

Route::resource('refeicao', 'RefeicaoController');

Route::resource('escola', 'EscolaController');

Route::resource('restaurante', 'RestauranteController');


Route::post('/cupomalimentacao/store', 'CupomAlimentacaoController@store')->name('cupomalimentacao.store');
Route::get('/cupomalimentacao/today', 'CupomAlimentacaoController@today')->name('cupomalimentacao.today');
Route::get('cupomalimentacao/print/{cupomalimentacao}', ['as' => 'cupomalimentacao.show', 'uses' => 'CupomAlimentacaoController@show']);

Route::get('/cupomalimentacao/validate', 'CupomAlimentacaoController@validateView')->name('cupomalimentacao.validate');
Route::post('/cupomalimentacao/validate', 'CupomAlimentacaoController@validateView')->name('cupomalimentacao.validate');
Route::post('/cupomalimentacao/dovalidate', 'CupomAlimentacaoController@doValidate')->name('cupomalimentacao.dovalidate');


Route::get('/pagamentoalimentacao/create', 'PagamentoAlimentacaoController@create')->name('pagamentoalimentacao.create');
Route::get('/pagamentoalimentacao/list', 'PagamentoAlimentacaoController@list')->name('pagamentoalimentacao.list');
Route::post('/pagamentoalimentacao/create', 'PagamentoAlimentacaoController@setPagamento')->name('pagamentoalimentacao.setpagamento');
// Route::post('/pagamentoalimentacao/create', 'PagamentoAlimentacaoController@doPayment')->name('pagamentoalimentacao.dopayment');


Route::get('/relatorio/meuscupons', 'CupomAlimentacaoController@reportMeusCupons')->name('relatorio.meuscupons');
Route::post('/relatorio/meuscupons', 'CupomAlimentacaoController@reportMeusCupons')->name('relatorio.meuscupons');
