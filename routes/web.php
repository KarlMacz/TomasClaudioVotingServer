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

Route::get('/', 'HomeController@index')->name('home.get.index');
Route::get('election_results', 'HomeController@electionResults')->name('home.get.election_results');
Route::get('download', 'HomeController@download')->name('home.get.download');
