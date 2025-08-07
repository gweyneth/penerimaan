<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenerimaController extends Controller
{
    /**
     * Menampilkan daftar semua penerima.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Penerima::query();

        if ($search) {
            $query->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%');
        }

        // PERUBAHAN DI SINI: Gunakan simplePaginate
        $penerimas = $query->latest()->simplePaginate($perPage);

        $penerimas->appends($request->all());

        return view('admin.penerima.index', compact('penerimas', 'search', 'perPage'));
    }

    /**
     * Menampilkan form untuk membuat penerima baru.
     */
    public function create()
    {
        return view('admin.penerima.create');
    }

    /**
     * Menyimpan data penerima baru ke dalam database.
     */
    public function store(Request $request)
    {
        // PERUBAHAN PADA VALIDASI 'status_aktif'
        $validatedData = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'kelas'         => 'required|string|max:50',
            'status_aktif'  => 'required|boolean', // Diubah dari 'nullable' menjadi 'required'
        ]);
        
        // HAPUS BARIS INI:
        // $validatedData['status_aktif'] = $request->has('status_aktif');
        // Logika ini tidak diperlukan lagi karena nilainya (0 atau 1) sudah langsung dari form.

        Penerima::create($validatedData);

        return redirect()->route('admin.penerima.index')->with('success', 'Data penerima berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu penerima.
     */
    public function show(Penerima $penerima)
    {
        return view('admin.penerima.show', compact('penerima'));
    }

    /**
     * Menampilkan form untuk mengedit data penerima.
     */
    public function edit(Penerima $penerima)
    {
        return view('admin.penerima.edit', compact('penerima'));
    }

    /**
     * Mengupdate data penerima yang ada di database.
     */
    public function update(Request $request, Penerima $penerima)
    {
        // PERUBAHAN PADA VALIDASI 'status_aktif'
        $validatedData = $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'kelas'         => 'required|string|max:50',
            'status_aktif'  => 'required|boolean', // Diubah dari 'nullable' menjadi 'required'
        ]);
        
        // HAPUS BARIS INI:
        // $validatedData['status_aktif'] = $request->has('status_aktif');
        // Logika ini tidak diperlukan lagi.

        $penerima->update($validatedData);

        return redirect()->route('admin.penerima.index')->with('success', 'Data penerima berhasil diperbarui.');
    }

    /**
     * Menghapus data penerima dari database.
     */
    public function destroy(Penerima $penerima)
    {
        $penerima->delete();
        return redirect()->route('admin.penerima.index')->with('success', 'Data penerima berhasil dihapus.');
    }
}
