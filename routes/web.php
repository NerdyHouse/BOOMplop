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
    return view('welcome');
});

Route::get('vid-test', function () {
    return view('vid-test');
});
Route::get('media-test', function () {
    return view('media-test');
});
Route::get('vidjs-test', function () {
    return view('vidjs-test');
});
