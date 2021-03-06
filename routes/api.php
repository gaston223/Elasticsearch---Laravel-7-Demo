<?php

use App\Http\Controllers\PunchlineController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest:api']], function (){
    Route::get('punchlines/{page_size}/{page_number}', [PunchlineController::class, 'getPunchlinesByPopularity']);
    Route::get('artists/punchlines/{page_size}/{page_number}', [PunchlineController::class, 'getArtistsWhoHavePunchlines']);
    Route::get('/', [PunchlineController::class, 'search']);
    Route::post('/punchline/create', [PunchlineController::class, 'create']);
    Route::post('/punchline/{punchline_id}/delete', [PunchlineController::class, 'delete']);
});
