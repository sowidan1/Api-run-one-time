<?php

namespace App\Http\Controllers;

use App\Models\ApiStartTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{

    public function limitedApi(Request $request)
    {
        $getData = ApiStartTime::first();
        if (!$getData) {
            ApiStartTime::create([
                'api_start_time' => Carbon::now()->addSeconds(20),
            ]);

            return response()->json(['message' => 'API hit successful.'], 200);
        }

        $apiStartTime = Carbon::parse($getData->api_start_time);
        $currentTime = Carbon::now();

        if ($currentTime->greaterThanOrEqualTo($apiStartTime)) {
            abort(404, 'API no longer available.');
        }

        return response()->json([
            'message' => 'API hit successful.',
            'time_left' => $apiStartTime->diffInSeconds($currentTime) . ' seconds remaining.',
        ], 200);

    }
}
