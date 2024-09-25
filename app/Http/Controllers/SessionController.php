<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    //Terminate all sessions
    public function logoutAll(Request $request)
    {
        $user = Auth::guard('web')->user(); 

        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'User not authenticated']);
        }

        $currentSessionId = Session::getId();

        // Delete all sessions 
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        // Log out the user from the current session
        Auth::guard('web')->logout(); 

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Logged out from all devices successfully!');
    }
}
