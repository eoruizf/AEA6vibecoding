<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');


Route::get('/', function () {
    return view('home');
});
