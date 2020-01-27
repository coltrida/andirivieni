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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/selezioneTavolo/{tavolo}', 'HomeController@selezioneTavolo')->name('selezioneTavolo');
Route::post('/prenotaTavolo', 'HomeController@prenotaTavolo')->name('prenotaTavolo');


Route::get('/caricatavoli', 'AdminController@caricatavoli')->name('caricatavoli');
Route::get('/caricamenu', 'AdminController@caricamenu')->name('caricamenu');
Route::get('/caricacamerieri', 'AdminController@caricacamerieri')->name('caricacamerieri');
