<?php

use App\Http\Controllers\Api\QuestionTypeController;
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

Route::post('/login', 'AuthController@getToken');

Route::group(["middleware" => ['auth:sanctum', 'admin']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Route::post('/question-types', 'QuestionTypeController@store');
    //Route::resource("question-types", 'QuestionTypeController');

    Route::resources([
        "question-types" => 'QuestionTypeController',
        "questions" => 'QuestionController',
    ]);

    //Route::resource("traning_infos", API\TraningInfoController::class);
});
