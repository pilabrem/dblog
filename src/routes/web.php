<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Pilabrem\DBLog\http\Controllers','prefix' => 'dblog'], function () {
    Route::get('/', 'LogController@index')->name('dblog.index');
    Route::get('/{table}/{id?}', 'LogController@tableIndex')->name('dblog.table.index');
    Route::get('/log/{id}/show', 'LogController@show')->name('dblog.table.show');
});