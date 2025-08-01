<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Seleksi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0A70F1;
            --dark-blue: #053B7A;
            --light-gray: #f0f4f8;
            --text-dark: #1a202c;
            --text-light: #4a5568;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Left Panel */
        .info-panel {
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            color: white;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .info-panel h1 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .info-panel p {
            font-size: 1rem;
            line-height: 1.6;
            opacity: 0.9;
            /* PERUBAHAN DI SINI */
            font-style: italic;
            font-weight: 500;
        }

        /* Right Panel (Form) */
        .form-panel {
            padding: 3rem 2.5rem;
        }

        .form-panel h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .form-panel .subtitle {
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-light);
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(10, 112, 241, 0.2);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            background: var(--dark-blue);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }
            .info-panel {
                display: none; /* Sembunyikan panel kiri di mobile */
            }
            .form-panel {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Panel Kiri -->
        <div class="info-panel">
            <h1>Selamat Datang Kembali!</h1>
            <p>"Kepemimpinan adalah kapasitas untuk menerjemahkan visi menjadi kenyataan. Mulailah langkah pertamamu di sini."</p>
        </div>

        <!-- Panel Kanan (Form) -->
        <div class="form-panel">
            <h2>Login Akun</h2>
            <p class="subtitle">Silakan masuk untuk melanjutkan.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>

                <div>
                    <button type="submit" class="btn-submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
