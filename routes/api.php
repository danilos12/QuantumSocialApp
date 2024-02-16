<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\RegisterController;


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

Route::post('auth/register', RegisterController::class); // Define route using RegisterController method
// Route::post('auth/register', RegisterController::class)->middleware('auth');

Route::get('scrape/', [RegisterController::class, 'scrapeMetaTags']);

Route::get('test', function () {
    return response()->json(['message' => 'API route is working!']);
});