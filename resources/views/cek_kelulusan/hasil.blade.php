<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan Calon OSIS & MPK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0d47a1;
            --dark-blue: #0b3a82;
            --light-gray: #f0f4f8;
            --text-dark: #1a202c;
            --text-light: #4a5568;
            --success-green: #16a34a;
            --error-red: #dc2626;
            --border-color: #e2e8f0;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .main-container {
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid var(--border-color);
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* Header Section */
        .card-header {
            padding: 1.5rem 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-lolos { background-color: var(--primary-blue); }
        .header-tidak-lolos { background-color: var(--error-red); }
        .header-pending { background-color: var(--text-light); }

        .header-title {
            font-size: 1.25rem;
            font-weight: 800;
            text-transform: uppercase;
        }
        .header-logo {
            font-size: 1.5rem;
            font-weight: 900;
            letter-spacing: -1px;
        }

        /* Body Section */
        .card-body { padding: 2.5rem; }

        .main-info-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 2rem;
        }

        .student-identity h2 {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--text-dark);
            margin: 0 0 0.5rem 0;
            line-height: 1.1;
        }
        .student-identity p {
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--text-light);
            margin: 0;
        }

        .qr-code {
            width: 120px;
            height: 120px;
            background-color: var(--light-gray);
            border-radius: 8px;
            padding: 8px;
        }

        /* Detailed Info Section */
        .detailed-info-grid {
            margin-top: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem 2rem;
        }
        .info-item { text-align: left; }
        .info-label {
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        .info-value {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 1.125rem;
        }

        /* --- PERUBAHAN DESAIN DI SINI --- */
        .result-message {
            margin-top: 2.5rem;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: left;
            border-left: 5px solid;
        }
        .result-lolos { background-color: #f0fdf4; border-left-color: var(--success-green); }
        .result-tidak-lolos { background-color: #fef2f2; border-left-color: var(--error-red); }
        .result-pending { background-color: #f8fafc; border-left-color: var(--text-light); }

        .result-message h3 {
            margin-top: 0;
            font-size: 1.125rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .result-message h3 svg {
            width: 24px;
            height: 24px;
        }
        .result-lolos h3 { color: #15803d; }
        .result-tidak-lolos h3 { color: #b91c1c; }
        .result-pending h3 { color: #334155; }

        .result-message p { 
            font-size: 1rem; 
            color: var(--text-light); 
            line-height: 1.6;
            margin-bottom: 0;
            padding-left: calc(24px + 0.75rem); /* Align with text */
        }
        /* --- AKHIR PERUBAHAN DESAIN --- */

        .back-link-wrapper {
            text-align: center;
            margin-top: 2.5rem;
        }
        .back-link {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-blue);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        .back-link:hover { background-color: var(--dark-blue); }

        #confetti-canvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1000; }
        
        /* Responsive */
        @media (max-width: 768px) {
            body { padding: 1rem; align-items: flex-start; }
            .main-info-grid { grid-template-columns: 1fr; text-align: center; }
            .student-identity { margin-bottom: 1.5rem; }
            .qr-code { margin: 0 auto; }
            .detailed-info-grid { grid-template-columns: 1fr; }
            .card-body { padding: 1.5rem; }
            .student-identity h2 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <canvas id="confetti-canvas"></canvas>

    <div class="main-container">
        @if ($penerima->kodeAkses->status_kelulusan == 'Lolos')
            <header class="card-header header-lolos">
                <div class="header-title">Selamat! Anda Dinyatakan Lulus</div>
                <div class="header-logo">OSIS & MPK</div>
            </header>
        @elseif ($penerima->kodeAkses->status_kelulusan == 'Tidak Lolos')
            <header class="card-header header-tidak-lolos">
                <div class="header-title">Mohon Maaf, Anda Belum Lulus</div>
                <div class="header-logo">OSIS & MPK</div>
            </header>
        @else
            <header class="card-header header-pending">
                <div class="header-title">Status Seleksi</div>
                <div class="header-logo">OSIS & MPK</div>
            </header>
        @endif

        <main class="card-body">
            <section class="main-info-grid">
                <div class="student-identity">
                    <h2>{{ $penerima->nama_lengkap }}</h2>
                    <p>Calon Pengurus OSIS & MPK</p>
                </div>
                <div class="qr-code">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><path fill="#1a202c" d="M10,10 h20 v20 h-20z M40,10 h10 v10 h-10z M60,10 h10 v10 h-10z M80,10 h10 v20 h-10z M10,40 h10 v10 h-10z M40,40 h10 v10 h-10z M60,40 h10 v10 h-10z M80,40 h10 v10 h-10z M10,60 h20 v10 h-20z M40,60 h10 v10 h-10z M60,60 h20 v20 h-20z M10,80 h10 v10 h-10z M40,80 h10 v10 h-10z M80,80 h10 v10 h-10z M50,50 h10 v10 h-10z M30,30 h10 v10 h-10z M70,30 h10 v10 h-10z M30,70 h10 v10 h-10z M70,70 h10 v10 h-10z M50,20 h10 v10 h-10z M20,50 h10 v10 h-10z M50,80 h10 v10 h-10z"/></svg>
                </div>
            </section>

            <section class="detailed-info-grid">
                <div class="info-item">
                    <div class="info-label">Tanggal Lahir</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($penerima->tanggal_lahir)->format('d F Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kelas</div>
                    <div class="info-value">{{ $penerima->kelas }}</div>
                </div>
            </section>
            
            @if ($penerima->kodeAkses->status_kelulusan == 'Lolos')
                <section class="result-message result-lolos">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        <span>Langkah Selanjutnya</span>
                    </h3>
                    <p>Selamat atas pencapaian Anda! Informasi mengenai jadwal pelantikan dan program kerja awal akan diinformasikan lebih lanjut melalui grup resmi Calon Pengurus. Harap pantau terus informasinya.</p>
                </section>
            @elseif ($penerima->kodeAkses->status_kelulusan == 'Tidak Lolos')
                <section class="result-message result-tidak-lolos">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                        <span>Terima Kasih Atas Partisipasi Anda</span>
                    </h3>
                    <p>Kami sangat mengapresiasi usaha dan waktu yang telah Anda berikan. Jangan berkecil hati, tetaplah semangat dan teruslah berkarya di bidang lain. Kontribusimu untuk sekolah tetap kami nantikan!</p>
                </section>
            @else
                <section class="result-message result-pending">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm-1-5h2v2h-2zm0-8h2v6h-2z"/></svg>
                        <span>Hasil Masih Dalam Proses</span>
                    </h3>
                    <p>Pengumuman kelulusan untuk Anda masih dalam tahap finalisasi. Silakan cek kembali halaman ini secara berkala. Terima kasih atas kesabaran Anda.</p>
                </section>
            @endif

            <div class="back-link-wrapper">
                <a href="{{ route('kelulusan.form') }}" class="back-link">Kembali ke Halaman Pengecekan</a>
            </div>
        </main>
    </div>

    @if ($penerima->kodeAkses->status_kelulusan == 'Lolos')
    <script>
        // Simple Confetti Animation
        function triggerConfetti() {
            const canvas = document.getElementById('confetti-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            let confettiPieces = [];

            function ConfettiPiece(x, y) {
                this.x = x; this.y = y;
                this.size = Math.random() * 8 + 4;
                this.vx = Math.random() * 4 - 2;
                this.vy = Math.random() * 5 + 2;
                this.color = `hsl(${Math.random() * 360}, 100%, 50%)`;
                this.opacity = 1;
            }
            ConfettiPiece.prototype.update = function() {
                this.x += this.vx; this.y += this.vy;
                this.opacity -= 0.01; this.vy += 0.05;
            };
            ConfettiPiece.prototype.draw = function() {
                ctx.globalAlpha = this.opacity;
                ctx.fillStyle = this.color;
                ctx.fillRect(this.x, this.y, this.size, this.size);
                ctx.globalAlpha = 1;
            };
            function createConfetti() {
                for (let i = 0; i < 200; i++) {
                    confettiPieces.push(new ConfettiPiece(Math.random() * canvas.width, -Math.random() * canvas.height));
                }
            }
            function animate() {
                requestAnimationFrame(animate);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                confettiPieces.forEach((piece, index) => {
                    if (piece.opacity <= 0) confettiPieces.splice(index, 1);
                    piece.update();
                    piece.draw();
                });
            }
            createConfetti();
            animate();
        }
        triggerConfetti();
    </script>
    @endif
</body>
</html>
