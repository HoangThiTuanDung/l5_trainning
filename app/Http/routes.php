<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories', 'CategoriesController', ['only' => ['index', 'show']]);

    Route::post('/lessons/answer', 'LessonsController@answer');

    Route::get('/lessons/partial', 'LessonsController@partial');

    Route::resource('lessons', 'LessonsController', ['only' => ['show']]);

    Route::resource('words', 'WordsController', ['only' => ['index']]);

    Route::get('/words/search', 'WordsController@search')->name('words.search');
});
