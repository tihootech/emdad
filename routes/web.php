<?php

// defaults
Route::view('/', 'welcome');
Auth::routes(['register' => false]);
Route::get('home', 'HomeController@index')->name('home');

// general user account control
Route::get('acc', 'UserController@edit');
Route::put('acc', 'UserController@update');

// master user control
// Route::post('users', 'UserController@store');
// Route::put('acc/{user}', 'UserController@update_password');
// Route::delete('acc/{user}', 'UserController@destroy');

// madadjus and introduces
Route::resource('madadju', 'MadadjuController');
Route::post('introduce', 'IntroduceController@introduce');
Route::get('introduce', 'IntroduceController@index');
Route::delete('introduce/{introduce}', 'IntroduceController@destroy');
Route::post('introduce/confirm/{introduce}', 'IntroduceController@confirm');
Route::post('introduce/status/{introduce}', 'IntroduceController@change_status');

// notifications
Route::get('notifications', 'NotificationController@index');
Route::get('notifications/create', 'NotificationController@create');
Route::post('notifications', 'NotificationController@store');
Route::put('notifications/{id}', 'NotificationController@update');
Route::delete('notifications/{id}', 'NotificationController@destroy');

// owner
Route::get('owners/{type}', 'OwnerController@index');
Route::get('owners/create/{type}', 'OwnerController@create');
Route::post('owners', 'OwnerController@store');
Route::get('owners/{type}/{owner_id}/edit', 'OwnerController@edit');
Route::put('owners/{owner_id}', 'OwnerController@update');
Route::delete('owners/{type}/{owner_id}', 'OwnerController@destroy');

// tools
Route::get('tools/{tool?}', 'ToolsController@tools')->name('tools');
