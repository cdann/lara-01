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
Route::get('/', 'WelcomeController@index');

Route::get('home', array('uses' =>'HomeController@index', 'as' => 'Home'));

Route::get('post', array('uses' => 'Test\PostsController@index', 'as' => 'AllPost'));
Route::get('post/{slug}', array('uses' => 'Test\PostsController@view', 'as' => 'PostView'));
Route::get('post/edit/{id}', array('uses' => 'Test\PostsController@edit', 'as' => 'PostEdit'));
Route::post('post/edit/{id}', array('uses' => 'Test\PostsController@update', 'as' => 'PostUpdate', 'before' => 'csrf'));
//Route::controllers(['monuse'=> 'PostsController']);

Route::group(['prefix' => 'user', 'middleware' => 'isAdmin'], function()
{
	Route::get('/', array('uses' =>'User\UserController@seeView', 'as' => 'UserView', ));
	Route::post('update/{id}', array('uses' =>'User\UserController@update', 'as' => 'UserUpdate', 'access' => 'himself'));
	Route::post('create', array('uses' =>'User\UserController@create', 'as' => 'UserCreate'));
	Route::get('edit/{id?}', array('uses' =>'User\UserController@edit', 'as' => 'UserEdit', 'id' => -1, 'access' => 'himself'));
	Route::get('delete/{id?}', array('uses' =>'User\UserController@delete', 'as' => 'UserDelete', 'access' => 'himself'));
});

Route::controllers([
	'user' => 'User\UserController',
	'password' => 'User\PasswordController',
]);

Route::group(['prefix' => 'contact'], function()
{
	Route::get('/', ['as' => 'ContactForm', function(){
		return view('contact');
	}]);
	Route::post('/',  array('uses' =>'ContactController@post', 'as' => 'ContactPost'));
});

