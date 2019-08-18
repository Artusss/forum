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
Route::get('category', 'CategoryController@index');
Route::get('category/{slug}', 'CategoryController@show')
    ->where('slug', '[A-Za-z0-9-_]+');
Route::get('/', 'TopicController@index');
Route::get('/topics', 'TopicController@index');
Route::get('topic/{slug}', 'TopicController@show')
    ->where('slug', '[A-Za-z0-9-_]+');

Route::post('/searched', 'TopicController@search');

Route::group(['middleware' => ['auth']], function (){
    Route::get('/new-topic', 'TopicController@create');
    Route::post('/new-topic', 'TopicController@store');
    Route::get('/edit-topic/{id}', 'TopicController@edit')
        ->where('id', '[0-9]+');
    Route::post('/update', 'TopicController@update');
    Route::post('/topic/{slug}/delete', 'TopicController@destroy')
        ->where('slug', '[A-Za-z0-9-_]+');
    Route::post('/topic/{slug}/smash-like', 'TopicController@smashLike')
        ->where('slug', '[A-Za-z0-9-_]+');
    Route::post('/topic/{slug}/make-dec', 'DecisionController@store')
        ->where('slug', '[A-Za-z0-9-_]+');
    Route::post('/topic/{slug}/delete-dec', 'DecisionController@destroy')
        ->where('slug', '[A-Za-z0-9-_]+');
});
Route::group(['prefix' => 'profile'], function(){
    Route::get('/', 'UserController@index');
    Route::get('/my/topics', 'UserController@my_topics');
    Route::get('/my/decisions', 'UserController@my_decisions');
});
