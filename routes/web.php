<?php
use App\Http\Controllers\HangupController;
use App\Http\Controllers\QutdueController;
use App\Http\Controllers\PcuserController;
use App\Http\Controllers\HangupdeallocateController;
use App\Http\Controllers\TrialbalanceController;
use App\Http\Controllers\InvoicelineController;
use App\Http\Controllers\BreakdownController;

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
    //Route::get('edit/', 'HangupController@edit');
    //Route::get('hangup','App\Http\Controllers\HangupController@index')->name('index');
    Route::resource('qutdue', 'QutdueController');
    Route::resource('pcuser', 'PcuserController');
    Route::resource('hangupdeallocate', 'HangupdeallocateController');
    Route::resource('trialbalance', 'TrialbalanceController');
    Route::resource('invoiceline', 'InvoicelineController');
    Route::resource('breakdown', 'BreakdownController');

    //Route::get('pcuser','PcuserController@index')->name('index');
    //Route::get('/pcuser', [PcuserController::class, 'index']);

    

    Route::resource('users', 'UsersController')->middleware('Role:Superadmin|Admin');
    Route::get('profileedit/{id}', 'ProfileController@edit');
    Route::put('profileupdate/{id}', 'ProfileController@update');

    Route::get('edit/{id}', 'CategoriesController@edit');
});
