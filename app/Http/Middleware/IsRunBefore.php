<?php

namespace App\Http\Middleware;

use App\Models\Flag;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class IsRunBefore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $flag = Flag::first();
        if($flag && $flag->is_run_before === 1) {
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
