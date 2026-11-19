<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function createAdmin(): View
    {
        return view('auth.login-admin');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $peran = $request->input('peran') === 'admin' ? 'admin' : 'nasabah';

        $request->authenticate();

        $user = $request->user();
        $salah = null;

        if ($user->role !== $peran) {
            $salah = $peran === 'admin'
                ? 'Akun ini bukan akun admin. Gunakan halaman login nasabah.'
                : 'Akun ini adalah akun admin. Gunakan halaman login admin.';
        } elseif ($user->status !== 'aktif') {
            $salah = 'Akun Anda belum diverifikasi admin.';
        }

        if ($salah) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route($peran === 'admin' ? 'login.admin' : 'login')
                ->withInput($request->only('email'))
                ->withErrors(['email' => $salah]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}