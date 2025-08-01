<x-layouts.admin>
    <x-slot name="title">
        Kelola Penerima
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
        .btn-info { background: #17a2b8; } /* New button color for "Lihat" */
        .status-badge { color: white; padding: 3px 10px; border-radius: 12px; font-size: 0.8em; }
        .status-aktif { background: #28a745; }
        .status-nonaktif { background: #dc3545; }
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
            <h2>Daftar Penerima</h2>
            <a href="{{ route('admin.penerima.create') }}" class="btn btn-success">+ Tambah Penerima</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penerimas as $penerima)
                    <tr>
                        <td>{{ $penerima->nama_lengkap }}</td>
                        <td>{{ \Carbon\Carbon::parse($penerima->tanggal_lahir)->format('d F Y') }}</td>
                        <td>{{ $penerima->jenis_kelamin }}</td>
                        <td>{{ $penerima->kelas }}</td>
                        <td>
                            @if ($penerima->status_aktif)
                                <span class="status-badge status-aktif">Aktif</span>
                            @else
                                <span class="status-badge status-nonaktif">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn btn-info view-detail-btn"
                                   data-nama="{{ $penerima->nama_lengkap }}"
                                   data-tgllahir="{{ \Carbon\Carbon::parse($penerima->tanggal_lahir)->format('d F Y') }}"
                                   data-jeniskelamin="{{ $penerima->jenis_kelamin }}"
                                   data-kelas="{{ $penerima->kelas }}"
                                   data-status="{{ $penerima->status_aktif ? 'Aktif' : 'Tidak Aktif' }}"
                                   data-dibuat="{{ $penerima->created_at->format('d F Y, H:i:s') }}"
                                   data-diperbarui="{{ $penerima->updated_at->format('d F Y, H:i:s') }}">
                                   Lihat
                                </a>
                                <a href="{{ route('admin.penerima.edit', $penerima) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.penerima.destroy', $penerima) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                            Belum ada data penerima.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 1.5rem;">
            {{ $penerimas->links() }}
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Detail Penerima</h2>
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
                <div class="detail-item"><div class="detail-label">Nama Lengkap</div><div class="detail-value">${data.nama}</div></div>
                <div class="detail-item"><div class="detail-label">Tanggal Lahir</div><div class="detail-value">${data.tglLahir}</div></div>
                <div class="detail-item"><div class="detail-label">Jenis Kelamin</div><div class="detail-value">${data.jenisKelamin}</div></div>
                <div class="detail-item"><div class="detail-label">Kelas</div><div class="detail-value">${data.kelas}</div></div>
                <div class="detail-item"><div class="detail-label">Status</div><div class="detail-value">${data.status}</div></div>
                <div class="detail-item"><div class="detail-label">Tanggal Dibuat</div><div class="detail-value">${data.dibuat}</div></div>
                <div class="detail-item"><div class="detail-label">Terakhir Diperbarui</div><div class="detail-value">${data.diperbarui}</div></div>
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
                    nama: this.dataset.nama,
                    tglLahir: this.dataset.tgllahir,
                    jenisKelamin: this.dataset.jeniskelamin,
                    kelas: this.dataset.kelas,
                    status: this.dataset.status,
                    dibuat: this.dataset.dibuat,
                    diperbarui: this.dataset.diperbarui
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
