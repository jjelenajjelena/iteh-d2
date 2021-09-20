<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('vakcine', 'VakcinaController@get' );

Route::get('ustanove', 'UstanovaController@get' );

Route::post('prijave', 'PrijavaController@createPrijava');
Route::get('prijave', 'PrijavaController@get');
Route::delete('prijave/{prijava}', 'PrijavaController@delete');
Route::put('prijave/{prijava}', 'PrijavaController@updatePrijava' );
