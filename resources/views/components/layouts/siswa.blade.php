<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f4f7f6; margin: 0; }
        .navbar { background: white; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .navbar-brand { font-weight: 700; font-size: 1.25rem; }
        .navbar-user { display: flex; align-items: center; gap: 15px; }
        .logout-button { background-color: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .main-container { padding: 2rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">Dashboard Siswa</div>
        <div class="navbar-user">
            <span>Selamat Datang, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </nav>

    <main class="main-container">
        {{ $slot }}
    </main>
</body>
</html>
