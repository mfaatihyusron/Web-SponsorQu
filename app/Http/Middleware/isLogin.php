<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLogin
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
        
        $routeName = $request->route()->getName();
        if (session()->has('user')) {
            if (is_object(session('user')) && session('user')->role == "admin" && $routeName == "/home") {
                return redirect('/admin')->with('status', 'Logged as Admin!');
            }

            return $next($request);
        }
        return redirect('/')->with('status','You must be logged in first!');
    }
}
