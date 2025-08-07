<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerima;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class AkunSiswaController extends Controller
{
    /**
     * Menampilkan halaman untuk men-generate akun.
     */
    public function index()
    {
        // PERUBAHAN DI SINI: Gunakan simplePaginate
        $penerimas = Penerima::with('user')->latest()->simplePaginate(15);
        return view('admin.akun_siswa.index', compact('penerimas'));
    }

    /**
     * Menampilkan daftar akun siswa yang sudah dibuat.
     */

    /**
     * Membuat akun user baru untuk seorang penerima.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => [
                'required',
                Rule::exists('penerimas', 'id')->where('user_id', null)
            ],
        ]);

        $penerima = Penerima::find($request->penerima_id);

        $baseUsername = strtolower(str_replace(' ', '', $penerima->nama_lengkap));
        $baseEmail = $baseUsername . '@penerima.com';
        $email = $baseEmail;
        $counter = 1;
        while (User::where('email', $email)->exists()) {
            $email = $baseUsername . $counter . '@penerima.com';
            $counter++;
        }

        $password = Str::random(8);

        // Asumsi ada kolom 'plain_password' di tabel users
        $user = User::create([
            'name' => $penerima->nama_lengkap,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'siswa',
            'plain_password' => $password,
        ]);

        $penerima->user_id = $user->id;
        $penerima->save();

        $message = "Akun untuk <strong>{$penerima->nama_lengkap}</strong> berhasil dibuat. <br>
                    Email: <strong>{$email}</strong> <br>
                    Password: <strong>{$password}</strong> (Harap segera catat!)";

        return redirect()->route('admin.akun-siswa.index')->with('success', $message);
    }

    /**
     * Menampilkan daftar akun siswa yang sudah dibuat.
     */
    public function daftarAkun()
    {
        $akunSiswa = User::where('role', 'siswa')
                         ->with('penerima.kodeAkses')
                         ->latest()
                         ->paginate(15);
        
        return view('admin.akun_siswa.daftar', compact('akunSiswa'));
    }

    /**
     * Mereset password untuk user yang dipilih.
     */
    public function resetPassword(Request $request, User $user)
    {
        if ($user->role !== 'siswa') {
            return redirect()->route('admin.akun-siswa.daftar')->with('error', 'Hanya akun siswa yang bisa direset.');
        }

        $newPassword = Str::random(8);

        $user->update([
            'password' => Hash::make($newPassword),
            'plain_password' => $newPassword, // Update juga password teks biasa
        ]);

        $message = "Password untuk <strong>{$user->name}</strong> berhasil direset. <br>
                    Password Baru: <strong>{$newPassword}</strong> (Harap segera catat!)";

        return redirect()->route('admin.akun-siswa.daftar')->with('success', $message);
    }

    /**
     * Generate dan stream PDF daftar akun.
     */
    public function cetakPdf()
    {
        // 1. Ambil SEMUA akun siswa (tanpa paginasi)
        $akunSiswa = User::where('role', 'siswa')
                         ->with('penerima.kodeAkses')
                         ->get();

        // 2. Siapkan data untuk dikirim ke view PDF
        $data = [
            'judul' => 'Daftar Akun Siswa Calon OSIS & MPK',
            'tanggal' => date('d F Y'),
            'akunSiswa' => $akunSiswa
        ];

        // 3. Load view PDF dengan data, lalu generate PDF
        $pdf = PDF::loadView('admin.akun_siswa.pdf', $data);

        // 4. Tampilkan PDF di browser
        return $pdf->stream('daftar-akun-siswa.pdf');
    }
}
