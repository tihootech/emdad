<?php


// defaults
Route::view('/', 'welcome');
Auth::routes(['register' => false]);
Route::get('home', 'HomeController@index')->name('home');

// general user account control
Route::get('acc', 'UserController@edit');
Route::put('acc', 'UserController@update');

// master user control
Route::get('users/{type}', 'UserController@index');
Route::post('users', 'UserController@store');
Route::put('acc/{user}', 'UserController@update_password');
Route::delete('acc/{user}', 'UserController@destroy');

// resources
Route::resource('madadju', 'MadadjuController')->except('show');
