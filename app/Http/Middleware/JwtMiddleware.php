<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {   

            JWTAuth::parseToken()->authenticate();

            $user = auth()->guard("api")->user(); 

            if(!isset($user->id)){
                return response()->json( [
                    "error" => true , 
                    "message" => "token_invalid"
                ]);
            }
            
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json( [
                    "error" => true , 
                    "message" => "token_invalid"
                ]);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json( [
                    "error" => true , 
                    "message" => "token_invalid"
                ]);
            } else {
                return response()->json( [
                    "error" => true , 
                    "message" => "token_invalid"
                ]);
            }
        }

        return $next($request);
    }
}
