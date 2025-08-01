<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kelulusan Calon OSIS & MPK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-accent: #2563eb;
            --dark-bg: #111827;
            --card-bg: #1f2937;
            --border-color: #374151;
            --text-primary: #f9fafb;
            --text-secondary: #9ca3af;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-primary);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .full-page-container {
            width: 100%;
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1.2fr; /* Two columns, form is slightly larger */
        }

        /* Info Panel (Left Side) */
        .info-panel {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop') center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
            text-align: left;
        }
        .info-panel .logo {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--primary-accent);
            margin-bottom: 2rem;
        }
        .info-panel h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 1rem 0;
            line-height: 1.2;
        }
        .info-panel p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 400px;
            line-height: 1.6;
        }

        /* Form Container (Right Side) */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            overflow-y: auto;
        }

        .main-container {
            width: 100%;
            max-width: 500px;
            transition: opacity 0.5s ease-out;
        }

        .card-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .card-header h1 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 0.5rem 0;
        }
        .card-header p {
            color: var(--text-secondary);
            margin: 0;
        }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-secondary);
        }
        .form-control {
            width: 100%;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            background-color: #374151;
            color: var(--text-primary);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control::placeholder { color: #6b7280; }
        .form-control:focus {
            outline: none;
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary-accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
            margin-top: 1rem;
        }
        .btn-submit:hover { background: #1d4ed8; }
        .btn-submit:active { transform: scale(0.98); }

        .alert-danger {
            background-color: #4c1d21;
            color: #fca5a5;
            border: 1px solid #7f1d1d;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Loading Spinner */
        .loading-container { display: none; text-align: center; padding: 4rem 2rem; }
        .spinner {
            width: 56px; height: 56px;
            border: 6px solid rgba(37, 99, 235, 0.2);
            border-top-color: var(--primary-accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1.5rem auto;
        }
        .loading-text { font-size: 1.25rem; font-weight: 500; }
        @keyframes spin { to { transform: rotate(360deg); } }
        
        /* Responsive */
        @media (max-width: 992px) {
            .full-page-container {
                grid-template-columns: 1fr;
            }
            .info-panel {
                display: none; /* Hide info panel on smaller screens */
            }
            .form-container {
                align-items: flex-start;
                padding-top: 4rem;
            }
        }
    </style>
</head>
<body>
    <div class="full-page-container">
        <!-- Panel Kiri (Info) -->
        <div class="info-panel">
            <div>
                <div class="logo">OSIS & MPK</div>
                <h1>Portal Pengumuman Hasil Seleksi</h1>
                <p>Setiap langkah besar dimulai dari satu keberanian kecil. Lihat hasil dari kerja kerasmu di sini.</p>
            </div>
        </div>

        <!-- Panel Kanan (Form) -->
        <div class="form-container">
            <div class="main-container" id="mainContainer">
                <header class="card-header">
                    <h1>Pengumuman Hasil Seleksi</h1>
                    <p>Masukkan data Anda untuk melihat hasil kelulusan.</p>
                </header>

                <form id="kelulusanForm" action="{{ route('kelulusan.check') }}" method="POST">
                    @csrf

                    @if($errors->has('gagal'))
                        <div class="alert-danger">
                            {{ $errors->first('gagal') }}
                        </div>
                    @endif
                    
                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kode_akses" class="form-label">Kode Akses</label>
                        <input type="text" id="kode_akses" name="kode_akses" class="form-control" placeholder="Masukkan kode akses unik Anda" required>
                    </div>

                    <button type="submit" class="btn-submit">Lihat Hasil Seleksi</button>
                </form>
            </div>

            <div class="loading-container" id="loadingContainer">
                <div class="spinner"></div>
                <p class="loading-text">Mencari data Anda...</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('kelulusanForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            const form = this;
            const mainContainer = document.getElementById('mainContainer');
            const loadingContainer = document.getElementById('loadingContainer');

            mainContainer.style.opacity = '0';
            setTimeout(() => {
                mainContainer.style.display = 'none';
                loadingContainer.style.display = 'block';
            }, 500);

            setTimeout(function() {
                form.submit();
            }, 2500); 
        });
    </script>
</body>
</html>
