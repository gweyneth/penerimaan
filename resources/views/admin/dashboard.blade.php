<x-layouts.admin>
    <x-slot name="title">
        Halaman Utama Dashboard
    </x-slot>

    <style>
        :root {
            --primary-blue: #0A70F1;
            --success-green: #28a745;
            --danger-red: #dc3545;
            --warning-orange: #ffc107;
            --info-cyan: #17a2b8;
            --text-dark: #1a202c;
            --text-light: #4a5568;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            border-left: 5px solid var(--primary-blue);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .stat-card .icon svg {
            width: 24px;
            height: 24px;
        }
        
        .stat-card .info .title {
            font-size: 0.875rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }
        .stat-card .info .value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        /* Card Colors */
        .card-penerima { border-color: var(--primary-blue); }
        .card-penerima .icon { background-color: var(--primary-blue); }
        
        .card-akun { border-color: var(--info-cyan); }
        .card-akun .icon { background-color: var(--info-cyan); }
        
        .card-lolos { border-color: var(--success-green); }
        .card-lolos .icon { background-color: var(--success-green); }
        
        .card-tidak-lolos { border-color: var(--danger-red); }
        .card-tidak-lolos .icon { background-color: var(--danger-red); }

        .quick-links {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .quick-links h2 {
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        .link-item {
            display: block;
            padding: 1rem;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dark);
            background-color: #f8f9fa;
            font-weight: 500;
            transition: all 0.2s;
        }
        .link-item:hover {
            background-color: var(--primary-blue);
            color: white;
            transform: scale(1.03);
        }
    </style>

    <div class="stats-grid">
        <!-- Card Total Penerima -->
        <div class="stat-card card-penerima">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
            </div>
            <div class="info">
                <div class="title">Total Penerima</div>
                <div class="value">{{ $totalPenerima }}</div>
            </div>
        </div>

        <!-- Card Total Akun -->
        <div class="stat-card card-akun">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div class="info">
                <div class="title">Akun Dibuat</div>
                <div class="value">{{ $totalAkun }}</div>
            </div>
        </div>

        <!-- Card Lolos -->
        <div class="stat-card card-lolos">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="info">
                <div class="title">Dinyatakan Lolos</div>
                <div class="value">{{ $totalLolos }}</div>
            </div>
        </div>

        <!-- Card Tidak Lolos -->
        <div class="stat-card card-tidak-lolos">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <div class="info">
                <div class="title">Tidak Lolos</div>
                <div class="value">{{ $totalTidakLolos }}</div>
            </div>
        </div>
    </div>

    <div class="quick-links">
        <h2>Akses Cepat</h2>
        <div class="links-grid">
            <a href="{{ route('admin.penerima.index') }}" class="link-item">Kelola Data Penerima</a>
            <a href="{{ route('admin.kode-akses.index') }}" class="link-item">Kelola Kode Akses</a>
            <a href="{{ route('admin.akun-siswa.index') }}" class="link-item">Generate Akun Siswa</a>
            <a href="{{ route('admin.akun-siswa.daftar') }}" class="link-item">Lihat Daftar Akun</a>
        </div>
    </div>
</x-layouts.admin>
