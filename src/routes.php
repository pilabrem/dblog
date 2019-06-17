<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Pilabrem\DBLog\Controllers','prefix' => 'pilabrem/dblog'], function () {
    Route::get('/', 'LogController@index')->name('dblog.index');
    Route::get('/{table}', 'LogController@tableIndex')->name('dblog.table.index');
    Route::get('/{table}/{id}', 'LogController@show')->name('dblog.table.show');
});