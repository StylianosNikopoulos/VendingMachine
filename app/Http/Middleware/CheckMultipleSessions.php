<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

//Check if the user is logged in on other device
class CheckMultipleSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if($user){
            $activeSessions = DB::table('sessions')
                                ->where('user_id', $user->id)
                                ->count();

            if($activeSessions>1){
                return redirect()->route('dashboard')->with('alert','There is another active session using this account.');
            }
        }

        return $next($request);
    }
}
