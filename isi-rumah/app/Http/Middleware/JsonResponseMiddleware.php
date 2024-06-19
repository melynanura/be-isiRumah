<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->exception instanceof ValidationException) {
            $errors = $response->exception->errors();
            $firstError = array_values($errors)[0][0]; // Mendapatkan pesan error pertama

            return response()->json([
                'message' => $firstError,
            ], 422);
        }

        return $response;
    }
}
