<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EnsureStep1Completed
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
        if (!$request->session()->has('registration')) {
        return redirect()->route('register.step1');
        }
        //    errorでたらif (!Session::has('registration.name') || !Session::has('registration.email')) {
            // return redirect()->route('register.step1');
        // }にしてみる

        return $next($request);
    }
}
