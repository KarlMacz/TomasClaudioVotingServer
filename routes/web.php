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
    Route::get('settings', 'AdminController@settings')->name('admin.get.settings');
    Route::get('candidates', 'AdminController@candidates')->name('admin.get.candidates');
    Route::get('candidates/add', 'AdminController@addCandidate')->name('admin.get.candidates_add');
    Route::get('candidates/edit/{id}', 'AdminController@editCandidate')->name('admin.get.candidates_edit');
    Route::get('parties', 'AdminController@parties')->name('admin.get.parties');
    Route::get('parties/add', 'AdminController@addParty')->name('admin.get.parties_add');
    Route::get('parties/edit/{id}', 'AdminController@editParty')->name('admin.get.parties_edit');
    Route::get('positions', 'AdminController@positions')->name('admin.get.positions');
    Route::get('positions/add', 'AdminController@addPosition')->name('admin.get.positions_add');
    Route::get('positions/edit/{id}', 'AdminController@editPosition')->name('admin.get.positions_edit');
    Route::get('voters', 'AdminController@voters')->name('admin.get.voters');
    Route::get('voters/add', 'AdminController@addVoter')->name('admin.get.voters_add');
    Route::get('voters/edit/{id}', 'AdminController@editVoter')->name('admin.get.voters_edit');
    Route::get('reports/tally', 'AdminController@tallyReport')->name('admin.get.reports_tally');
    Route::get('reports/tally/print', 'AdminController@printTallyReport')->name('admin.get.reports_print_tally');
    Route::get('reports/summary', 'AdminController@summaryReport')->name('admin.get.reports_summary');
    Route::get('reports/summary/print', 'AdminController@printSummaryReport')->name('admin.get.reports_print_summary');

    Route::post('candidates/store', 'AdminController@storeCandidate')->name('admin.post.candidates_store');
    Route::post('candidates/remove', 'AdminController@removeCandidate')->name('admin.post.candidates_remove');
    Route::post('parties/store', 'AdminController@storeParty')->name('admin.post.parties_store');
    Route::post('parties/remove', 'AdminController@removeParty')->name('admin.post.parties_remove');
    Route::post('positions/store', 'AdminController@storePosition')->name('admin.post.positions_store');
    Route::post('positions/remove', 'AdminController@removePosition')->name('admin.post.positions_remove');
    Route::post('voters/store', 'AdminController@storeVoter')->name('admin.post.voters_store');
    Route::post('voters/remove', 'AdminController@removeVoter')->name('admin.post.voters_remove');
    Route::post('settings/store', 'AdminController@storeSettings')->name('admin.post.settings_store');
    Route::post('notifications/results', 'AdminController@resultsNotification')->name('admin.post.notifications_results');
});
