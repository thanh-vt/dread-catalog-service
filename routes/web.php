<?php

use Illuminate\Support\Facades\Route;

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
    $a = 1;
    $b = 2;
    $c = $a + $b;
    Log::info('This is some useful information.', ['client_ip' => $_SERVER['REMOTE_ADDR']]);
    return view('welcome', ['c' => $c]);
});

