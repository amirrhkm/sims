<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('name', $request->name)->first();

            // Check if user exists
            if (!$user) {
                return redirect()->back()
                    ->with('username_error', true)
                    ->withInput($request->except('password'));
            }

            // Check if password is correct
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()
                    ->with('password_error', true)
                    ->withInput($request->except('password'));
            }

            // Check if user is active (if you have an active status)
            if (isset($user->active) && !$user->active) {
                return redirect()->back()
                    ->with('inactive_error', true)
                    ->withInput($request->except('password'));
            }

            // Login successful
            Auth::login($user);
            if (Auth::user()->role === 'pemohon') {
                return redirect()->route('pemohon.dashboard');
            } elseif (Auth::user()->role === 'pengurus') {
                return redirect()->route('pengurus.dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['system_error' => 'An unexpected error occurred. Please try again.'])
                ->withInput($request->except('password'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
