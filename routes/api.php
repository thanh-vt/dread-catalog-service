<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello/{name}/{birth_of_year}', [TestController::class, 'hello']);
Route::get('/goodbye/{name}/{birth_of_year}', [TestController::class, 'goodbye']);

Route::apiResources([
    'products' => ProductController::class,
    'categories' => CategoryController::class
], [
//    'middleware' => 'auth:api'
]);


Route::get('/categories-tree', [CategoryController::class, 'tree']);

