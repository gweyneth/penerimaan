<x-layouts.admin>
    <x-slot name="title">
        Kelola Akun Siswa
    </x-slot>

    <style>
        .table-container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        .table thead { background-color: #f8f9fa; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-success { background: #28a745; }
        .btn-info { background: #17a2b8; } /* Warna untuk tombol lihat daftar */
        .btn-disabled { background: #6c757d; cursor: not-allowed; opacity: 0.65; }
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 5px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>

    <div class="table-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <div>
                <h2>Generate Akun untuk Siswa</h2>
                <p style="margin: 0; color: #555;">Halaman ini digunakan untuk membuat akun login bagi para penerima.</p>
            </div>
            {{-- TOMBOL BARU DITAMBAHKAN DI SINI --}}
            <a href="{{ route('admin.akun-siswa.daftar') }}" class="btn btn-info">Lihat Daftar Akun</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Penerima</th>
                    <th>Kelas</th>
                    <th>Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penerimas as $penerima)
                    <tr>
                        <td>{{ $penerima->nama_lengkap }}</td>
                        <td>{{ $penerima->kelas }}</td>
                        <td>
                            @if ($penerima->user)
                                <span style="color: green; font-weight: bold;">Sudah Dibuat</span><br>
                                <small>Email: {{ $penerima->user->email }}</small>
                            @else
                                <span style="color: #dc3545;">Belum Dibuat</span>
                            @endif
                        </td>
                        <td>
                            @if ($penerima->user)
                                <button class="btn btn-disabled" disabled>Akun Sudah Ada</button>
                            @else
                                <form action="{{ route('admin.akun-siswa.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="penerima_id" value="{{ $penerima->id }}">
                                    <button type="submit" class="btn btn-success">Buat Akun</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">
                            Belum ada data penerima. Silakan tambah data di menu "Kelola Penerima" terlebih dahulu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $penerimas->links() }}
        </div>
    </div>
</x-layouts.admin>
