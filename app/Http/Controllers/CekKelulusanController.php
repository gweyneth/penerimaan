<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerima;

class CekKelulusanController extends Controller
{
    /**
     * Menampilkan halaman form untuk cek kelulusan.
     */
    public function showCheckForm()
    {
        return view('cek_kelulusan.form');
    }

    /**
     * Memproses data dari form dan menampilkan hasilnya.
     */
    public function checkKelulusan(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'nama_lengkap'    => 'required|string',
            'tanggal_lahir'   => 'required|date',
            'kode_akses'      => 'required|string',
        ]);

        // 2. Cari penerima berdasarkan nama dan tanggal lahir
        $penerima = Penerima::where('nama_lengkap', $validated['nama_lengkap'])
                            ->where('tanggal_lahir', $validated['tanggal_lahir'])
                            ->first();

        // 3. Lakukan pengecekan
        if (!$penerima) {
            // Jika data penerima tidak ditemukan
            return back()->withErrors(['gagal' => 'Data tidak ditemukan. Pastikan Nama Lengkap dan Tanggal Lahir sesuai.'])->withInput();
        }

        if (!$penerima->kodeAkses) {
            // Jika penerima ada tapi belum punya kode akses
            return back()->withErrors(['gagal' => 'Data Kode Akses untuk penerima ini tidak ditemukan.'])->withInput();
        }

        if ($penerima->kodeAkses->kode !== $validated['kode_akses']) {
            // Jika kode akses yang dimasukkan salah
            return back()->withErrors(['gagal' => 'Kode Akses yang Anda masukkan salah.'])->withInput();
        }

        // 4. Jika semua data cocok, tampilkan halaman hasil
        return view('cek_kelulusan.hasil', compact('penerima'));
    }
}
