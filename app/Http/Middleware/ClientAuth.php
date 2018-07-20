<?php

namespace App\Http\Middleware;

use Closure;

class ClientAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $clientSecret = $request->client_secret;

        if ($clientSecret != env('CLIENT_SECRET', "af1b562ea01ad0123235cd650c20ef32")){
             $response = [
                "status" => false,
                "message" => "Autentikasi Gagal ".$clientSecret." = ".env('CLIENT_SECRET')
            ];
            return response()->json($response);
        }
        return $next($request);
    }
}
