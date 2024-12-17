<?php

use App\Models\TimeDelete;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/time', function (Request $request) {
    // Create the record
    $row = TimeDelete::create([
        'time_unit'  => $request->time_unit,
        'time_value' => $request->time_value,
        'start_time' => $request->start_time,
    ]);

    // Map time units to Carbon methods
    $unitMapping = [
        'minutes'   => 'addMinutes',
        'hours'   => 'addHours',
        'days'    => 'addDays',
        'months'  => 'addMonths',
    ];

    // Default to start_time
    $startTime = Carbon::parse($row->start_time)->startOfSecond();

    // Dynamically call the appropriate Carbon method
    $timeMethod = $unitMapping[$row->time_unit] ?? null;

    if ($timeMethod) {
        $afterAdd = $startTime->{$timeMethod}((int) $row->time_value);
        $row->update(['end_time' => $afterAdd]);
    }

    return response()->json(['message' => 'Time converted successfully']);
})->name('time');
