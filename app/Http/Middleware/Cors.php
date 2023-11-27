<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = '*';
        if(isset($_SERVER['SERVER_NAME'])) {
            $origin = "https://".$_SERVER['SERVER_NAME'];   
        }
        return $next($request)
            ->header('Access-Control-Allow-Origin', "http://www.backoffice.tamarind.fr")
            ->header('Access-Control-Allow-Headers', "Origin, X-Requested-With, Content-Type, Accept")
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Credentials',' true')
            ;
    }
}
