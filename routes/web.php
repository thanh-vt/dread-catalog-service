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
Route::prefix('/revice-commerce/dread-catalog-service')->group(function () {
    Route::get('/', function () {
        $a = 1;
        $b = 2;
        $c = $a + $b;
        return view('welcome');
    });
});

