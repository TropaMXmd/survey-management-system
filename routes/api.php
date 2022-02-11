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

    Route::resources([
        "question-types" => 'QuestionTypeController',
        "questions" => 'QuestionController',
    ]);

    Route::post('/exams', 'ExamController@store');
    Route::get('/exams', 'ExamController@index');
    Route::patch('/exams/{examId}', 'ExamController@update');
    Route::delete('/exams/{examId}', 'ExamController@destroy');
});

//---------------For general user-------------------
Route::get('/exams/{examId}', 'ExamController@show');
