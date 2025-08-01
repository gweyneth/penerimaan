<x-layouts.admin>
    <x-slot name="title">
        Detail Kode Akses
    </x-slot>

    <style>
        .detail-container { background: white; padding: 2rem; border-radius: 8px; }
        .detail-item { display: flex; padding: 0.75rem 0; border-bottom: 1px solid #eee; }
        .detail-label { font-weight: 600; width: 200px; color: #555; }
        .detail-value { flex-grow: 1; }
        .btn { display: inline-block; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-secondary { background: #6c757d; }
        .status-badge { color: white; padding: 3px 10px; border-radius: 12px; font-size: 0.8em; }
        .status-lolos { background: #28a745; }
        .status-tidak-lolos { background: #dc3545; }
        .status-pending { background: #6c757d; }
    </style>

    <div class="detail-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2>Detail Kode Akses</h2>
            <a href="{{ route('admin.kode-akses.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <hr style="margin-bottom: 2rem; border: 0; border-top: 1px solid #eee;">

        <div class="detail-item">
            <div class="detail-label">Penerima</div>
            <div class="detail-value">{{ $kodeAkse->penerima->nama_lengkap ?? 'Penerima Dihapus' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Kode Akses</div>
            <div class="detail-value"><strong>{{ $kodeAkse->kode }}</strong></div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Status Kelulusan</div>
            <div class="detail-value">
                @if ($kodeAkse->status_kelulusan == 'Lolos')
                    <span class="status-badge status-lolos">Lolos</span>
                @elseif ($kodeAkse->status_kelulusan == 'Tidak Lolos')
                    <span class="status-badge status-tidak-lolos">Tidak Lolos</span>
                @else
                    <span class="status-badge status-pending">Belum Diproses</span>
                @endif
            </div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tanggal Kadaluarsa</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($kodeAkse->tanggal_kadaluarsa)->format('d F Y') }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Tanggal Dibuat</div>
            <div class="detail-value">{{ $kodeAkse->created_at->format('d F Y, H:i:s') }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-label">Terakhir Diperbarui</div>
            <div class="detail-value">{{ $kodeAkse->updated_at->format('d F Y, H:i:s') }}</div>
        </div>
    </div>
</x-layouts.admin>
