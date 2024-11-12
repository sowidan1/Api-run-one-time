<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CheckController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class isRunBeforeUseVar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $f = session('flagVar');
        dd($f);
        if(session('flagVar') === 1) {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'API endpoint not found',
                    'data' => null
                ], 404);
            }

            abort(404);

        }
        return $next($request);
    }
}
