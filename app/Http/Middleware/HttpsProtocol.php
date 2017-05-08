<?php 

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (!$request->secure() && env('APP_ENV') === 'pro') {
                return redirect()->secure($request->getRequestUri());
            }
            
            $request->setTrustedProxies( [ $request->getClientIp() ] ); 

            return $next($request); 
    }
}
