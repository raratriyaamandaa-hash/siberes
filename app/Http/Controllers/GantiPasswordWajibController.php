<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class GantiPasswordWajibController extends Controller
{
    public function tampil(Request $request)
    {
        if (! $request->user()->wajib_ganti_password) {
            return redirect()->route('dashboard');
        }

        return view('auth.ganti-password');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user();

        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password baru tidak boleh sama dengan password sementara.']);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'wajib_ganti_password' => false,
        ])->save();

        return redirect()->route('dashboard')->with('status', 'Password berhasil diganti.');
    }
}