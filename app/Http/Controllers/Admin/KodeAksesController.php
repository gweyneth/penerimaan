<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeAkses;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KodeAksesController extends Controller
{
    public function index()
    {
        $kodeAkses = KodeAkses::with('penerima')->latest()->paginate(10);
        return view('admin.kode_akses.index', compact('kodeAkses'));
    }

    public function create()
    {
        $penerimas = Penerima::where('status_aktif', true)
                             ->whereDoesntHave('kodeAkses')
                             ->get();
        return view('admin.kode_akses.create', compact('penerimas'));
    }

    public function store(Request $request)
    {
        // Tidak ada perubahan di sini, status akan default 'Belum Diproses'
        $request->validate([
            'penerima_id' => [
                'required',
                Rule::exists('penerimas', 'id')->where('status_aktif', true),
                Rule::unique('kode_akses', 'penerima_id') 
            ],
            'tanggal_kadaluarsa' => 'required|date|after:today',
        ]);

        KodeAkses::create([
            'penerima_id' => $request->penerima_id,
            'kode' => Str::upper(Str::random(8)),
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
        ]);

        return redirect()->route('admin.kode-akses.index')->with('success', 'Kode akses berhasil dibuat.');
    }

    public function show(KodeAkses $kodeAkse)
    {
        return view('admin.kode_akses.show', compact('kodeAkse'));
    }

    public function edit(KodeAkses $kodeAkse)
    {
        return view('admin.kode_akses.edit', compact('kodeAkse'));
    }

    /**
     * Mengupdate kode akses.
     */
    public function update(Request $request, KodeAkses $kodeAkse)
    {
        // PERUBAHAN DI SINI
        $validatedData = $request->validate([
            'tanggal_kadaluarsa' => 'required|date|after:today',
            // Tambahkan validasi untuk status kelulusan
            'status_kelulusan' => ['required', Rule::in(['Lolos', 'Tidak Lolos', 'Belum Diproses'])],
        ]);

        $kodeAkse->update($validatedData);

        return redirect()->route('admin.kode-akses.index')->with('success', 'Data kode akses berhasil diperbarui.');
    }

    public function destroy(KodeAkses $kodeAkse)
    {
        $kodeAkse->delete();
        return redirect()->route('admin.kode-akses.index')->with('success', 'Kode akses berhasil dihapus.');
    }
}
