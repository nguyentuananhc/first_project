<?php

use Illuminate\Http\Request;
use App\Player;

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
Route::post('auth/login', 'NguonHocBongController@login');
Route::post('auth/update-score', 'NguonHocBongController@updateScore');
Route::get('user-info/{id}', function(Request $request, $id) {
    $player = Player::findOrFail($id);
    $player->update($request->all());

    return $player;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
