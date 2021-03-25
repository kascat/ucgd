<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'unities'], function() {
    Route::get('/', 'UnityController@index')->name('unities');
    Route::get('/list', 'UnityController@list')->name('unities-list');
});
