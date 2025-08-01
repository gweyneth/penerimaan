<x-layouts.admin>
    <x-slot name="title">
        Buat Kode Akses Baru
    </x-slot>

    <style>
        .form-container { background: white; padding: 2rem; border-radius: 8px; }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .btn { display: inline-block; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-success { background: #28a745; }
        .btn-secondary { background: #6c757d; }
        .invalid-feedback { color: #dc3545; font-size: 0.875em; margin-top: 0.25rem; }
    </style>

    <div class="form-container">
        <h2>Form Buat Kode Akses</h2>
        <p>Pilih penerima yang berstatus aktif untuk membuatkan kode akses.</p>
        <hr style="margin-bottom: 2rem; border: 0; border-top: 1px solid #eee;">

        <form action="{{ route('admin.kode-akses.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="penerima_id" class="form-label">Pilih Penerima (Hanya yang Aktif)</label>
                <select id="penerima_id" name="penerima_id" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Penerima --</option>
                    @forelse ($penerimas as $penerima)
                        <option value="{{ $penerima->id }}" {{ old('penerima_id') == $penerima->id ? 'selected' : '' }}>
                            {{ $penerima->nama_lengkap }} (Kelas: {{ $penerima->kelas }})
                        </option>
                    @empty
                        <option value="" disabled>Tidak ada penerima aktif yang bisa dipilih.</option>
                    @endforelse
                </select>
                @error('penerima_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa') }}" required>
                 @error('tanggal_kadaluarsa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Buat Kode</button>
                <a href="{{ route('admin.kode-akses.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</x-layouts.admin>
