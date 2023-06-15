<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        try{

            if ($user->level == 'admin') {
                return $next($request);
            } else {
                return redirect('/dashboard')->with(['user' => $user]);
            }
            
            return $next($request);
        }catch (exception $e){
            return redirect('/dashboard')->with(['user' => $user]);
        }
    }
}
