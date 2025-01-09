<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRegistrationFee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // dd($request->routeIs('payment'));
        // Redirect if user has not paid the registration fee
        if ($user && $user->fee_for_register > 0 && !request()->routeIs('payment')) {
            return redirect('payment');
        }

        return $next($request);
    }
}
