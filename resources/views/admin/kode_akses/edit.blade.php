<x-layouts.admin>
    <x-slot name="title">
        Edit Kode Akses
    </x-slot>

    <style>
        .form-container { background: white; padding: 2rem; border-radius: 8px; }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .form-control:disabled { background-color: #e9ecef; }
        .btn { display: inline-block; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-primary { background: #007bff; }
        .btn-secondary { background: #6c757d; }
        .invalid-feedback { color: #dc3545; font-size: 0.875em; margin-top: 0.25rem; }
    </style>

    <div class="form-container">
        <h2>Form Edit Kode Akses</h2>
        <hr style="margin-bottom: 2rem; border: 0; border-top: 1px solid #eee;">

        <form action="{{ route('admin.kode-akses.update', $kodeAkse) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Penerima</label>
                <input type="text" class="form-control" value="{{ $kodeAkse->penerima->nama_lengkap }}" disabled>
            </div>

            <div class="form-group">
                <label class="form-label">Kode Akses</label>
                <input type="text" class="form-control" value="{{ $kodeAkse->kode }}" disabled>
            </div>

            <div class="form-group">
                <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                <select id="status_kelulusan" name="status_kelulusan" class="form-control" required>
                    <option value="Belum Diproses" {{ old('status_kelulusan', $kodeAkse->status_kelulusan) == 'Belum Diproses' ? 'selected' : '' }}>
                        Belum Diproses
                    </option>
                    <option value="Lolos" {{ old('status_kelulusan', $kodeAkse->status_kelulusan) == 'Lolos' ? 'selected' : '' }}>
                        Lolos
                    </option>
                    <option value="Tidak Lolos" {{ old('status_kelulusan', $kodeAkse->status_kelulusan) == 'Tidak Lolos' ? 'selected' : '' }}>
                        Tidak Lolos
                    </option>
                </select>
                @error('status_kelulusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa', $kodeAkse->tanggal_kadaluarsa) }}" required>
                 @error('tanggal_kadaluarsa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.kode-akses.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</x-layouts.admin>
