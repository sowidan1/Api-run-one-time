<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckController extends Controller
{
    public function oneTime(Request $request)
    {
        session('flagVar', 1);
        return response()->json(['message' => 'First time running']);
    }
}
