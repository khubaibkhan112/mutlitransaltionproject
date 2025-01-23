<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponseTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next) {
        $start = microtime(true);
    
        $response = $next($request);
    
        $duration = (microtime(true) - $start) * 1000; // Convert to milliseconds
        $response->headers->set('X-Response-Time', "{$duration}ms");
    
        return $response;
    }
    
}
