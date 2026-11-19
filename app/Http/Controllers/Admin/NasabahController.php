<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NasabahController extends Controller
{
    public function index()
    {
        $menunggu = User::with('nasabah')
            ->where('role', 'nasabah')->where('status', 'menunggu')->get();
        $aktif = Nasabah::with('user')->whereNotNull('kode')->orderBy('kode')->get();

        return view('admin.nasabah.index', compact('menunggu', 'aktif'));
    }

    public function setujui(User $user)
    {
        $nasabah = $user->nasabah;
        $nasabah->update(['kode' => 'NSB-'.str_pad($nasabah->id, 3, '0', STR_PAD_LEFT)]);
        $user->forceFill(['status' => 'aktif'])->save();

        return back()->with('status', 'Nasabah disetujui, ID nasabah dibuat otomatis.');
    }

    public function tolak(User $user)
    {
        $user->delete();

        return back()->with('status', 'Pendaftaran ditolak.');
    }

    public function resetPassword(User $user)
    {
        abort_unless($user->role === 'nasabah', 403);

        $baru = Str::random(8);
        $user->forceFill(['password' => Hash::make($baru), 'wajib_ganti_password' => true])->save();

        return back()->with('status', 'Password '.$user->name.' direset. Password sementara: '.$baru
            .' (berikan ke nasabah; nasabah wajib menggantinya saat login berikutnya, dan password ini tidak akan ditampilkan lagi).');
    }
}
