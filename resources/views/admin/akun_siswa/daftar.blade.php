<x-layouts.admin>
    <x-slot name="title">
        Daftar Akun Siswa
    </x-slot>

    <style>
        .table-container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        .table thead { background-color: #f8f9fa; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-secondary { background: #6c757d; }
        .btn-warning { background: #ffc107; color: #1f2937; }
        .btn-danger { background-color: #c82333; } /* Warna untuk tombol PDF */
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 5px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .action-buttons { display: flex; gap: 5px; }
        .header-actions { display: flex; gap: 10px; } /* Untuk menata tombol di header */
    </style>

    <div class="table-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div>
                <h2>Daftar Akun Siswa</h2>
                <p style="margin: 0; color: #555;">Halaman ini menampilkan semua akun siswa yang aktif di sistem.</p>
            </div>
            
            {{-- PERUBAHAN DI SINI --}}
            <div class="header-actions">
                <a href="{{ route('admin.akun-siswa.cetak-pdf') }}" class="btn btn-danger" target="_blank">Cetak PDF</a>
                <a href="{{ route('admin.akun-siswa.index') }}" class="btn btn-secondary">Kembali ke Generator</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Email (Username)</th>
                    <th>Password</th>
                    <th>Kode Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($akunSiswa as $akun)
                    <tr>
                        <td>{{ $akun->name }}</td>
                        <td>
                            {{ $akun->penerima ? \Carbon\Carbon::parse($akun->penerima->tanggal_lahir)->format('d M Y') : 'N/A' }}
                        </td>
                        <td>{{ $akun->email }}</td>
                        <td>
                            <strong>{{ $akun->plain_password ?? 'Tidak Tersimpan' }}</strong>
                        </td>
                        <td>
                            <strong>{{ $akun->penerima?->kodeAkses?->kode ?? 'Belum Dibuat' }}</strong>
                        </td>
                        <td>
                           <div class="action-buttons">
                                <form action="{{ route('admin.akun-siswa.reset', $akun) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset password untuk akun ini? Password lama akan hilang.')">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Reset</button>
                                </form>
                           </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">
                            Belum ada akun siswa yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $akunSiswa->links() }}
        </div>
    </div>
</x-layouts.admin>
