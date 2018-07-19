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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('register', 'Auth\LoginController@showRegistrationForm')->name('register');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function() {
    Route::get('dashboard', 'AdminController@index')->name('admin.get.index');
    Route::get('results', 'AdminController@electionResults')->name('admin.get.election_results');
    Route::get('voter_reset', 'AdminController@voterReset')->name('admin.get.voter_reset');
    Route::get('settings', 'AdminController@settings')->name('admin.get.settings');
    Route::get('candidates', 'AdminController@candidates')->name('admin.get.candidates');
    Route::get('parties', 'AdminController@parties')->name('admin.get.parties');
    Route::get('positions', 'AdminController@positions')->name('admin.get.positions');
    Route::get('voters', 'AdminController@voters')->name('admin.get.voters');
});
