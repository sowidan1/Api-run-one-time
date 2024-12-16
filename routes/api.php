<?php

use App\Enums\FlagVar;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OsamaController;
use App\Models\Flag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::middleware('isRunBefore')->group(function () {

//     Route::get('/one-time', function (Request $request) {
//         Flag::create(['is_run_before' => true]);
//         return response()->json(['message' => 'First time running']);
//     });
// });

// Route::get('/limited-api', [ApiController::class, 'limitedApi']);

Route::get('/delete', [OsamaController::class, 'myTemporaryFunction']);

// Route::get('/file-add-content', [FileController::class, 'file']);

Route::get('/time-delete', [OsamaController::class, 'timeDelete'])->middleware('CheckTheTime');
