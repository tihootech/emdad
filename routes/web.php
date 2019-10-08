<?php


// defaults
Route::view('/', 'welcome');
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

// user account control
Route::get('/acc', 'UserController@edit');
Route::put('/acc', 'UserController@update');

// resources
Route::resource('madadjus', 'MadadjuController');
