<?php

use App\Models\TimeDelete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/time', function (Request $request) {
    TimeDelete::create([
        'time_unit' => $request->time_unit,
        'time_value' => $request->time_value,
        'start_time' => $request->start_time,
    ]);

    return response()->json(['message' => 'Time converted successfully']);
})->name('time');
