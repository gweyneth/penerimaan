<x-layouts.admin>
    <x-slot name="title">
        Kelola Kode Akses
    </x-slot>

    <style>
        /* General Styles */
        .table-container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        .table thead { background-color: #f8f9fa; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 5px; text-decoration: none; color: white; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-success { background: #28a745; }
        .btn-primary { background: #007bff; }
        .btn-danger { background: #dc3545; }
        .btn-info { background: #17a2b8; }
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 5px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .action-buttons { display: flex; gap: 5px; }

        /* Modal Styles */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: #fefefe; margin: 10% auto; padding: 2rem; border: 1px solid #888; width: 80%; max-width: 600px; border-radius: 8px; position: relative; animation: fadeIn 0.3s; }
        @keyframes fadeIn { from {opacity: 0; transform: translateY(-20px);} to {opacity: 1; transform: translateY(0);} }
        .close-button { color: #aaa; position: absolute; top: 10px; right: 20px; font-size: 28px; font-weight: bold; }
        .close-button:hover, .close-button:focus { color: black; text-decoration: none; cursor: pointer; }
        .detail-item { display: flex; padding: 0.75rem 0; border-bottom: 1px solid #eee; }
        .detail-label { font-weight: 600; width: 200px; color: #555; }
        .detail-value { flex-grow: 1; }
    </style>

    <div class="table-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2>Daftar Kode Akses</h2>
            <a href="{{ route('admin.kode-akses.create') }}" class="btn btn-success">+ Buat Kode Akses</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Penerima</th>
                    <th>Kode Akses</th>
                    <th>Status Kelulusan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kodeAkses as $kode)
                    <tr>
                        <td>{{ $kode->penerima->nama_lengkap ?? 'Penerima Dihapus' }}</td>
                        <td><strong>{{ $kode->kode }}</strong></td>
                        <td>
                            <!-- TAMPILKAN STATUS KELULUSAN -->
                            @if ($kode->status_kelulusan == 'Lolos')
                                <span class="status-badge status-lolos">Lolos</span>
                            @elseif ($kode->status_kelulusan == 'Tidak Lolos')
                                <span class="status-badge status-tidak-lolos">Tidak Lolos</span>
                            @else
                                <span class="status-badge status-pending">Belum Diproses</span>
                            @endif
                        </td>
                        <td>{{ $kode->created_at->format('d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($kode->tanggal_kadaluarsa)->format('d F Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn btn-info view-detail-btn"
                                   data-penerima="{{ $kode->penerima->nama_lengkap ?? 'N/A' }}"
                                   data-kode="{{ $kode->kode }}"
                                   data-kadaluarsa="{{ \Carbon\Carbon::parse($kode->tanggal_kadaluarsa)->format('d F Y') }}"
                                   data-dibuat="{{ $kode->created_at->format('d F Y, H:i:s') }}">
                                   Lihat
                                </a>
                                <a href="{{ route('admin.kode-akses.edit', $kode) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.kode-akses.destroy', $kode) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kode ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">
                            Belum ada kode akses yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $kodeAkses->links() }}
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Detail Kode Akses</h2>
            <hr style="margin-top: 1rem; margin-bottom: 1rem; border: 0; border-top: 1px solid #eee;">
            <div id="modal-body">
                <!-- Detail content will be injected here by JavaScript -->
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('detailModal');
        const modalBody = document.getElementById('modal-body');
        const closeButton = document.querySelector('.close-button');

        // Function to open the modal
        function openModal(data) {
            modalBody.innerHTML = `
                <div class="detail-item"><div class="detail-label">Penerima</div><div class="detail-value">${data.penerima}</div></div>
                <div class="detail-item"><div class="detail-label">Kode Akses</div><div class="detail-value"><strong>${data.kode}</strong></div></div>
                <div class="detail-item"><div class="detail-label">Tanggal Kadaluarsa</div><div class="detail-value">${data.kadaluarsa}</div></div>
                <div class="detail-item"><div class="detail-label">Tanggal Dibuat</div><div class="detail-value">${data.dibuat}</div></div>
            `;
            modal.style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = 'none';
        }

        // Add event listeners to all "Lihat" buttons
        document.querySelectorAll('.view-detail-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const data = {
                    penerima: this.dataset.penerima,
                    kode: this.dataset.kode,
                    kadaluarsa: this.dataset.kadaluarsa,
                    dibuat: this.dataset.dibuat,
                };
                openModal(data);
            });
        });

        // Event listeners for closing the modal
        closeButton.addEventListener('click', closeModal);
        window.addEventListener('click', function (event) {
            if (event.target == modal) {
                closeModal();
            }
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });
    });
    </script>
</x-layouts.admin>
