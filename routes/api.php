<?php

use App\Models\Flag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('isRunBefore')->group(function () {

    Route::get('/one-time', function (Request $request) {
        Flag::create(['is_run_before' => true]);
        return response()->json(['message' => 'First time running']);
    });

});
