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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/tavoli', 'Api\HomeController');
Route::apiResource('/camerieri', 'Api\HomeController');

Route::get('/camerieri', 'Api\HomeController@camerieri');
Route::get('/ordini', 'Api\HomeController@ordini');
Route::get('/tavoloConOrdine/{tavolo}', 'Api\HomeController@selezionaTavolo');
Route::get('/piatti', 'Api\HomeController@piatti');
Route::get('/categorie', 'Api\HomeController@categorie');
Route::get('/piattiOrdine', 'Api\HomeController@piattiOrdine');
Route::get('/piattiOrdineSpecifico/{order}', 'Api\HomeController@piattiOrdineSpecifico');

Route::post('/prenotaTavolo', 'Api\HomeController@prenotaTavolo');

