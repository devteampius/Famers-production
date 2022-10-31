<?php
use App\Http\Controllers\HangupController;
  Route::get('/', ['uses'=>'DashboardController@index']);
  
Route::get('login', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
Route::group(['prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware'=>['auth']], function() {
    Route::get('/', ['uses'=>'DashboardController@index', 'as'=>'dash']);
    
    Route::resource('categories', 'CategoriesController');
    
    Route::resource('hangup', 'HangupController');

    Route::resource('users', 'UsersController')->middleware('Role:Superadmin|Admin');
    Route::get('profileedit/{id}', 'ProfileController@edit');
    Route::put('profileupdate/{id}', 'ProfileController@update');

    Route::get('edit/{id}', 'CategoriesController@edit');
});
