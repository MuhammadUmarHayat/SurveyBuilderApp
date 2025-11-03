<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\SurveyController;
 use App\Http\Controllers\QuestionController;
 use App\Http\Controllers\OptionController;
 use App\Http\Controllers\ResponseController;
 use App\Http\Controllers\AnswerController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



 Route::get('surveys', [SurveyController::class, 'index']);
 Route::post('surveys', [SurveyController::class, 'store']);
 Route::get('surveys/{survey}', [SurveyController::class, 'show']);
 Route::put('surveys/{survey}', [SurveyController::class, 'update']);
 Route::delete('surveys/{survey}', [SurveyController::class, 'destroy']);
 Route::post('surveys/{survey}/questions', [QuestionController::class, 'store']);
 Route::put('questions/{question}', [QuestionController::class, 'update']);
 Route::delete('questions/{question}', [QuestionController::class, 'destroy']);

 Route::post('questions/{question}/options', [OptionController::class, 'store']);
 Route::put('options/{option}', [OptionController::class, 'update']);
 Route::delete('options/{option}', [OptionController::class, 'destroy']);
 Route::post('surveys/{survey}/responses', [ResponseController::class, 'store']);
 Route::get('surveys/{survey}/results', [ResponseController::class, 'results']);