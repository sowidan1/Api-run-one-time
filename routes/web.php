<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/time', function (Request $request) {
    if($request->time_unit == 'months') {
        $sec = $request->time_value * 30 * 24 * 60 * 60;
    } elseif($request->time_unit == 'days') {
        $sec = $request->time_value * 24 * 60 * 60;
    } elseif($request->time_unit == 'hours') {
        $sec = $request->time_value * 60 * 60;
    } elseif($request->time_unit == 'minutes') {
        $sec = $request->time_value * 60;
    } elseif($request->time_unit == 'seconds') {
        $sec = $request->time_value;
    }
    return response()->json(['message' => 'Time converted successfully', 'seconds' => $sec]);
})->name('time');
