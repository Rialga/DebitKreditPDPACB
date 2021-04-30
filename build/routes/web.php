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
    return redirect('transaksi/');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'transaksi'], function () {
    Route::get('/', 'TransaksiController@index');
    Route::get('add/', 'TransaksiController@add');

    Route::post('create', 'TransaksiController@create');

    Route::get('edit/{id}', 'TransaksiController@edit');
    Route::post('update/', 'TransaksiController@update');

    Route::get('delete/{id}', 'TransaksiController@delete');

});
