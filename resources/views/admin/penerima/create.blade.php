<x-layouts.admin>
    <x-slot name="title">
        Tambah Penerima Baru
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
        <h2>Form Tambah Penerima</h2>
        <hr style="margin-bottom: 2rem; border: 0; border-top: 1px solid #eee;">

        <form action="{{ route('admin.penerima.store') }}" method="POST">
            @csrf

            {{-- Input lainnya tetap sama --}}
            <div class="form-group">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                 @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                 @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" id="kelas" name="kelas" class="form-control" value="{{ old('kelas') }}" required>
                 @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <!-- PERUBAHAN DI SINI: dari checkbox menjadi select dropdown -->
            <div class="form-group">
                <label for="status_aktif" class="form-label">Status</label>
                <select id="status_aktif" name="status_aktif" class="form-control" required>
                    <option value="1" selected>Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
                @error('status_aktif') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.penerima.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</x-layouts.admin>
