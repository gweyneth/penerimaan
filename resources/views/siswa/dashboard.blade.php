<x-layouts.siswa>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <style>
        :root {
            --primary-blue: #0A70F1;
            --dark-blue: #053B7A;
            --text-dark: #1a202c;
            --text-light: #4a5568;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 2rem;
            min-height: calc(100vh - 150px); /* Adjust based on navbar height */
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-text-content {
            padding: 1rem;
        }

        .welcome-text-content h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .welcome-text-content p {
            font-size: 1.125rem;
            color: var(--text-light);
            max-width: 450px;
        }

        .welcome-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .welcome-card .icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1.5rem auto;
            color: var(--primary-blue);
        }

        .welcome-card h2 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .welcome-card p {
            font-size: 1rem;
            color: var(--text-light);
        }

        .btn-cek {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            padding: 1rem 2rem;
            background: var(--primary-blue);
            color: white;
            text-decoration: none;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-cek:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(10, 112, 241, 0.3);
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1rem;
                min-height: auto;
            }
            .welcome-text-content {
                order: 1; /* Text comes first on mobile */
                padding: 0;
            }
            .welcome-card {
                order: 2; /* Card comes second */
                padding: 2rem;
            }
            .welcome-text-content h1 {
                font-size: 2rem;
            }
            .welcome-text-content p {
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>

    <div class="dashboard-grid">
        <div class="welcome-text-content">
            <h1>Portal Siswa OSIS & MPK</h1>
            <p>Selamat datang kembali! Di sini Anda dapat melihat semua informasi penting terkait proses seleksi.</p>
        </div>
        
        <div class="welcome-card">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16 1a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3h-3a1 1 0 1 1 0-2h3V2a1 1 0 0 1 1-1zM4 5a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1zm0 4a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1zm0 4a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1zm0 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1z"/></svg>
            </div>
            <h2>Pengumuman Hasil Seleksi</h2>
            <p>Lihat status kelulusan Anda dengan menekan tombol di bawah ini.</p>
            <a href="{{ route('kelulusan.form') }}" class="btn-cek">
                Cek Kelulusan Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width: 20px; height: 20px;"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg>
            </a>
        </div>
    </div>

</x-layouts.siswa>
