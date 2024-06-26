<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }

        return $request->expectsJson() ? response()->json(['status' => "Unauthorized", "message" => "You are not authorized"], Response::HTTP_UNAUTHORIZED) : abort(Response::HTTP_UNAUTHORIZED);
    
        // return $request->expectsJson() ? response()->json([
        //     'status' => "Unauthorized", 
        //     "message" => "You are not authorized", 
        //     'user' => $request->user(), 'auth' => Auth::user()->permissions()
        // ], Response::HTTP_UNAUTHORIZED) : abort(Response::HTTP_UNAUTHORIZED);
    
    }
}
