<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CheckController extends Controller
{
    public function oneTime(Request $request)
    {
        $configPath = config_path('custom_flag.php');

        $configContent = File::get($configPath);

        $newContent = str_replace("'value' => 0", "'value' => 1", $configContent);

        File::put($configPath, $newContent);

        Artisan::call('config:cache');

        return response()->json(['message' => 'First time running']);
    }
}
