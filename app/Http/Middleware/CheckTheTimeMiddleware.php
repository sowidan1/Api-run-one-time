<?php

namespace App\Http\Middleware;

use App\Models\TimeDelete;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTheTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $time = TimeDelete::first();

        if (!$time) {
            abort(404);
        }

        $startTime = \Carbon\Carbon::parse($time->start_time)->startOfSecond();

        $now = now()->startOfSecond();

        $afterAdd = null;

        if ($time->time_unit == 'seconds') {
            $afterAdd = $startTime->copy()->addSeconds((int) $time->time_value);
        } else if ($time->time_unit == 'hours') {
            $afterAdd = $startTime->copy()->addHours((int) $time->time_value);
        } else if ($time->time_unit == 'days') {
            $afterAdd = $startTime->copy()->addDays((int) $time->time_value);
        } else if ($time->time_unit == 'months') {
            $afterAdd = $startTime->copy()->addMonths((int) $time->time_value);
        }

        if ($afterAdd && $startTime <= $now && $now <= $afterAdd) {
            return $next($request);
        }

        abort(404);
    }
}
