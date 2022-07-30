<?php

namespace App\Http\Middleware;

use Closure;

class Mac
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
        $mac = substr(exec('getmac'), 0, 17);
        // dd($mac);
        
        // 58-91-CF-64-AD-4C
        // 58-91-CF-64-AD-48
        if($mac != '58-91-CF-64-AD-4C' && $mac != '58-91-CF-64-AD-48') 
        {
            abort(403,'For new System or maintainance call me @ 01010568214 , 01222471879 :: Eng. Mohamed Aboayadak');
        }
        return $next($request);
    }
}
