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


Auth::routes();

/*------ cameriere ------*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/selezioneTavolo/{tavolo}', 'HomeController@selezioneTavolo')->name('selezioneTavolo');
Route::post('/prenotaTavolo', 'HomeController@prenotaTavolo')->name('prenotaTavolo');
Route::post('/riepilogo/{order}', 'HomeController@riepilogo')->name('riepilogo');
Route::get('/inviaPrenotazione/{order}', 'HomeController@inviaPrenotazione')->name('inviaPrenotazione');
Route::get('/getNuoviOrdini', 'HomeController@getNuoviOrdini')->name('getNuoviOrdini');
Route::get('/getStatoTavoli', 'HomeController@getStatoTavoli')->name('getStatoTavoli');
Route::get('/annullaTavolo{tavolo}', 'HomeController@annullaTavolo')->name('annullaTavolo');

/*----- Admin -----*/
Route::get('/caricatavoli', 'AdminController@caricatavoli')->name('caricatavoli');
Route::post('/caricatavoli', 'AdminController@caricatavolisave')->name('caricatavolisave');
Route::get('/caricamenu', 'AdminController@caricamenu')->name('caricamenu');
Route::post('/caricamenu', 'AdminController@caricamenusave')->name('caricamenusave');
Route::get('/caricacamerieri', 'AdminController@caricacamerieri')->name('caricacamerieri');
Route::get('/caricacategorie', 'AdminController@caricacategorie')->name('caricacategorie');
Route::post('/caricacategorie', 'AdminController@caricacategoriesave')->name('caricacategoriesave');
Route::get('/statistiche', 'AdminController@statistiche')->name('statistiche');
Route::get('/infoOrdine/{order}', 'AdminController@infoOrdine')->name('infoOrdine');
Route::get('/chiudiOrdine/{order}', 'AdminController@chiudiOrdine')->name('chiudiOrdine');
Route::get('/stampa/{order}', 'AdminController@stampaOrdine')->name('stampaOrdine');
Route::get('/azzera', 'AdminController@azzera')->name('azzera');
Route::get('/eliminaPiatto/{food}', 'AdminController@eliminaPiatto')->name('eliminaPiatto');
Route::get('/rimettiPiatto/{food}', 'AdminController@rimettiPiatto')->name('rimettiPiatto');
Route::get('/modificaPiatto/{food}', 'AdminController@modificaPiatto')->name('modificaPiatto');
Route::post('/modificaPiatto/{food}', 'AdminController@modificaPiattosave')->name('modificaPiattosave');
