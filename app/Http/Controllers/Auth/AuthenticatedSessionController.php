<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Authenticate user
            $request->authenticate();

            // Regenerate session
            $request->session()->regenerate();

            // Set flash message for success
            session()->flash('success', 'Login berhasil!');

            // Redirect based on usertype
            if ($request->user()->usertype === 'admin') {
                return redirect('role/admin/dashboardAdmin');
            } else if ($request->user()->usertype === 'user') {
                return redirect('role/user/dashboardUser');
            }

            return redirect('dashboard');
        } catch (ValidationException $e) {
            // Handle login failure
            session()->flash('error', 'Login gagal! Periksa kembali kredensial Anda.');
            return redirect()->back();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login ');
    }
}
