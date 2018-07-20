<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckAuth
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
        $deviceId = $request->device_id;
        $token = $request->token;
        $sqlCheck = DB::select("SELECT * FROM user_session WHERE token_session = '$token' AND device_id = '{$deviceId}'");

        if ($clientSecret != env('CLIENT_SECRET', "af1b562ea01ad0123235cd650c20ef32") || count($sqlCheck) == 0){
             $response = [
                "status" => false,
                "message" => "Autentikasi Gagal."
            ];
            return response()->json($response);
        }
        return $next($request);
    }
}
