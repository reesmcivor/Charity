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

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::any('/', 'PeopleController@index')->name('home');
Route::any('/admin/people/index', 'PeopleController@index')->name('people');
Route::post('/admin/people/add_post', 'PeopleController@add_post')->name('people/add/post');
Route::get('/admin/people/add', 'PeopleController@add')->name('people/add');
Route::get('/admin/people/edit/{id}', 'PeopleController@edit');
Route::post('/admin/people/edit_post/{id}', 'PeopleController@edit_post')->name('people/edit/post');
Route::get('/admin/people/remove/{id}', 'PeopleController@remove')->name('people/remove');

Route::get('/admin/trades/index', 'TradesController@index')->name('trades');
Route::get('/admin/trades/add', 'TradesController@add')->name('trades/add');
Route::post('/admin/trades/add_post', 'TradesController@add_post')->name('trades/add/post');
Route::get('/admin/trades/edit/{id}', 'TradesController@edit')->name('trades/edit');
Route::post('/admin/trades/edit_post/{id}', 'TradesController@edit_post')->name('trades/edit/post');
Route::get('/admin/trades/remove/{id}', 'TradesController@remove')->name('trades/remove');

Route::any('/admin/jobs/index', 'JobsController@index')->name('jobs');
Route::get('/admin/jobs/add', 'JobsController@add')->name('jobs/add');
Route::post('/admin/jobs/add_post', 'JobsController@add_post')->name('jobs/add/post');
Route::get('/admin/jobs/edit/{id}', 'JobsController@edit')->name('jobs/edit');
Route::post('/admin/jobs/edit_post/{id}', 'JobsController@edit_post')->name('jobs/edit/post');
Route::get('/admin/jobs/remove/{id}', 'JobsController@remove')->name('jobs/remove');