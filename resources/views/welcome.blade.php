<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Portal Seleksi OSIS & MPK</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0A70F1;
            --dark-blue: #053B7A;
            --text-light: #e5e7eb; /* Warna teks lebih terang */
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827; /* Warna dasar jika gambar gagal dimuat */
            color: white;
            margin: 0;
        }

        /* NAVBAR */
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }
        .navbar {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .brand-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: white; /* Warna diubah */
            text-decoration: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            margin-left: 1.5rem;
            transition: color 0.2s;
        }
        .nav-links a:hover {
            color: white;
        }
        .nav-links .btn-login {
            background-color: var(--primary-blue);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: background-color 0.2s;
        }
        .nav-links .btn-login:hover {
            background-color: var(--dark-blue);
            color: white;
        }

        /* HERO SECTION */
        .hero-section {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 100vh; /* Diubah menjadi full screen */
            padding: 2rem;
            /* PERUBAHAN DI SINI: Menggunakan foto dari folder public */
            background: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.8)), 
                        url("{{ asset('images/fotooska.jpeg') }}") no-repeat center center;
            background-size: cover;
        }

        .hero-content {
            max-width: 800px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 900;
            color: white; /* Warna diubah */
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        .hero-content h1 span {
            color: #38bdf8; /* Warna aksen baru */
            background: none;
            -webkit-text-fill-color: unset;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--text-light); /* Warna diubah */
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: var(--primary-blue);
            color: white;
        }
        .btn-primary:hover {
            background-color: var(--dark-blue);
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(10, 112, 241, 0.3);
        }
        .btn-secondary {
            background-color: transparent;
            color: white; /* Warna diubah */
            box-shadow: inset 0 0 0 2px white; /* Border diubah */
        }
        .btn-secondary:hover {
            background-color: white;
            color: var(--dark-blue);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .hero-content p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    
    <header>
        <nav class="navbar">
            <a href="{{ url('/') }}" class="brand-logo">Jiva Abisatya</a>
            <div class="nav-links">
                <a href="https://wa.me/6287221383" target="_blank">Hubungi Kami</a>
                <a href="{{ route('login') }}" class="btn-login">Login</a>
            </div>
        </nav>
    </header>

    <main class="hero-section">
        <div class="hero-content">
            <h1>Portal Resmi <span>Seleksi OSIS & MPK</span></h1>
            <p>Satu langkah untuk menjadi bagian dari perubahan. Cek status kelulusan Anda atau masuk ke portal siswa di sini.</p>
            <div class="cta-buttons">
                <a href="{{ route('kelulusan.form') }}" class="btn btn-primary">Cek Kelulusan</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">Login Akun</a>
            </div>
        </div>
    </main>

</body>
</html>
