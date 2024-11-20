<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    // The start time and duration for the API availability
    private $cacheKey = 'api_start_time'; // Key to store the start time
    private $durationInSeconds = 30;     // API availability duration

    public function limitedApi(Request $request)
    {
        // Check if the start time is already set in the cache
        $startTime = Cache::get($this->cacheKey);

        if (!$startTime) {
            // Set the start time on the first hit
            $startTime = now();
            Cache::put($this->cacheKey, $startTime, $this->durationInSeconds); // Cache it for 30 seconds
        }

        // Calculate the elapsed time
        $currentTime = now();
        $elapsedTime = $currentTime->diffInSeconds($startTime);

        if ($elapsedTime > $this->durationInSeconds) {
            // Return 404 if the time limit has passed
            return response()->json(['message' => 'API access time expired.'], 404);
        }

        // Your API logic here
        return response()->json(['message' => 'API hit successful.'], 200);
    }
}
