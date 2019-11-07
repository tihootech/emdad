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
Route::post('notifications/{target}', 'NotificationController@store');
Route::put('notifications/{id}', 'NotificationController@update');
Route::delete('notifications/{id}', 'NotificationController@destroy');

// owner
Route::get('owner/{user}/edit', 'OwnerController@edit');
Route::put('owner/{owner_id}', 'OwnerController@update');
