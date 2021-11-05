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
Route::middleware(['api'])->group(function(){
    Route::get('/{redirect?}', [App\Http\Controllers\Api\v1\ShortenerController::class, 'shortenUrl']);
    Route::get('/urls/top', [App\Http\Controllers\Api\v1\ShortenerController::class, 'getTopUrls']);
});
