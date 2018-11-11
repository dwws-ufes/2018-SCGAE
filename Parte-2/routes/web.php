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


/*

Quando usa-se ::resource (exemplo para users)
Verb          Path                        Action  Route Name
GET           /users                      index   users.index
GET           /users/create               create  users.create
POST          /users                      store   users.store
GET           /users/{user}               show    users.show
GET           /users/{user}/edit          edit    users.edit
PUT|PATCH     /users/{user}               update  users.update
DELETE        /users/{user}               destroy users.destroy
*/

Route::redirect('/', '/home', 301);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
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
    Route::get('/pagamentoalimentacao', 'PagamentoAlimentacaoController@index')->name('pagamentoalimentacao.index');
    Route::post('/pagamentoalimentacao/create', 'PagamentoAlimentacaoController@setPagamento')->name('pagamentoalimentacao.setpagamento');
    Route::get('pagamentoalimentacao/{pagamentoalimentacao}', ['as' => 'pagamentoalimentacao.show', 'uses' => 'PagamentoAlimentacaoController@show']);


    Route::get('/relatorio/meuscupons', 'CupomAlimentacaoController@reportMeusCupons')->name('relatorio.meuscupons');
    Route::post('/relatorio/meuscupons', 'CupomAlimentacaoController@reportMeusCupons')->name('relatorio.meuscupons');
});
