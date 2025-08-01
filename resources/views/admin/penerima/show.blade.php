<x-layouts.admin>
    <x-slot name="title">
        Detail Data Penerima
    </x-slot>

    <style>
        .detail-container { background: white; padding: 2rem; border-radius: 8px; }
        .detail-item { display: flex; padding: 0.75rem 0; border-bottom: 1px solid #eee; }
        .detail-label { font-weight: 600; width: 200px; color: #555; }
        .detail-value { flex-grow: 1; }
        .btn { display: inline-block; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-secondary { background: #6c757d; }
    </style>

    <div class="detail-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2>Detail Penerima</h2>
            <a href="{{ route('admin.penerima.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <hr style="margin-bottom: 2rem; border: 0; border-top: 1px solid #eee;">

        <div class="detail-item">
            <div class="detail-label">Nama Lengkap</div>
            <div class="detail-value">{{ $penerima->nama_lengkap }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tanggal Lahir</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($penerima->tanggal_lahir)->format('d F Y') }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Jenis Kelamin</div>
            <div class="detail-value">{{ $penerima->jenis_kelamin }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Kelas</div>
            <div class="detail-value">{{ $penerima->kelas }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">{{ $penerima->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tanggal Dibuat</div>
            <div class="detail-value">{{ $penerima->created_at->format('d F Y, H:i:s') }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Terakhir Diperbarui</div>
            <div class="detail-value">{{ $penerima->updated_at->format('d F Y, H:i:s') }}</div>
        </div>
    </div>
</x-layouts.admin>
