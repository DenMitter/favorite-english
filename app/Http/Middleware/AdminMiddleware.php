<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        return \response()->json([
            'success' => false,
            'message' => 'You are not authorized to access this page.',
        ], Response::HTTP_FORBIDDEN);
    }
}
